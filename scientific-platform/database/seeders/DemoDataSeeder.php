<?php

namespace Database\Seeders;

use App\Enums\DocumentStatus;
use App\Enums\FieldOfStudy;
use App\Enums\ReviewStatus;
use App\Enums\UserRole;
use App\Models\Document;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Fictitious documents + reviews for local / QA testing.
 *
 * Comptes (après db:seed) — mot de passe par défaut depuis .env ou "password" :
 * - Admin:    config scientific-platform.admin_email
 * - Auteur:   config scientific-platform.author_email
 * - Reviewer: config scientific-platform.reviewer_email
 * - Reviewer 2: reviewer2@scientific-platform.test (même mot de passe que reviewer)
 */
class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::query()->where('email', config('scientific-platform.author_email'))->first();
        $reviewer1 = User::query()->where('email', config('scientific-platform.reviewer_email'))->first();

        if (! $author || ! $reviewer1) {
            $this->command->error('Exécutez d’abord : php artisan db:seed (ou migrate:fresh --seed).');

            return;
        }

        $reviewer2 = User::updateOrCreate(
            ['email' => 'reviewer2@scientific-platform.test'],
            [
                'name' => 'Dr. Sam Rivera',
                'password' => Hash::make(config('scientific-platform.reviewer_password')),
                'role' => UserRole::Reviewer,
                'field_of_study' => FieldOfStudy::PhysicsAstronomy,
                'email_verified_at' => now(),
            ]
        );

        $demoTitlePrefix = '[Demo] ';

        Document::query()
            ->where('user_id', $author->id)
            ->where('title', 'like', $demoTitlePrefix.'%')
            ->delete();

        Model::withoutEvents(function () use ($author, $reviewer1, $reviewer2, $demoTitlePrefix) {
            Document::create([
                'user_id' => $author->id,
                'title' => $demoTitlePrefix.'En attente de relecture',
                'abstract' => "Résumé factice : nous étudions la répartition des espèces le long d'un gradient altitudinal. Méthodes : inventaires standardisés, modèles additifs généralisés. Résultats attendus : diversité maximale à mi-pente.",
                'file_path' => null,
                'status' => DocumentStatus::Pending,
                'published_at' => null,
            ]);

            $d2 = Document::create([
                'user_id' => $author->id,
                'title' => $demoTitlePrefix.'Révisions demandées',
                'abstract' => "Proposition d'un cadre pour l'annotation sémantique des protocoles expérimentaux. Les reviewers ont demandé des clarifications sur le jeu de données et la taille d'effet.",
                'file_path' => null,
                'status' => DocumentStatus::UnderReview,
                'published_at' => null,
            ]);
            $d2->reviewers()->sync([$reviewer1->id, $reviewer2->id]);
            Review::create([
                'document_id' => $d2->id,
                'reviewer_id' => $reviewer1->id,
                'comment' => "Les figures 2–3 manquent d'échelle. Merci d'ajouter les intervalles de confiance et une description plus précise du prétraitement des données.",
                'status' => ReviewStatus::NeedsChanges,
            ]);

            $d3 = Document::create([
                'user_id' => $author->id,
                'title' => $demoTitlePrefix.'Accepté (prêt à publier)',
                'abstract' => "Synthèse sur les stratégies d'échantillonnage en écologie urbaine. Les deux évaluateurs recommandent l'acceptation après corrections mineures (déjà intégrées ici pour la démo).",
                'file_path' => null,
                'status' => DocumentStatus::Accepted,
                'published_at' => null,
            ]);
            $d3->reviewers()->sync([$reviewer1->id, $reviewer2->id]);
            Review::create([
                'document_id' => $d3->id,
                'reviewer_id' => $reviewer1->id,
                'comment' => 'Travail solide, méthodologie claire. Accepté.',
                'status' => ReviewStatus::Approved,
            ]);
            Review::create([
                'document_id' => $d3->id,
                'reviewer_id' => $reviewer2->id,
                'comment' => "J'approuve la version actuelle ; la discussion limite bien les biais potentiels.",
                'status' => ReviewStatus::Approved,
            ]);

            $d4 = Document::create([
                'user_id' => $author->id,
                'title' => $demoTitlePrefix.'Refusé',
                'abstract' => 'Hypothèse sur une corrélation entre deux variables environnementales sans mécanisme causal proposé. Les données ne soutiennent pas les conclusions.',
                'file_path' => null,
                'status' => DocumentStatus::Rejected,
                'published_at' => null,
            ]);
            $d4->reviewers()->sync([$reviewer1->id]);
            Review::create([
                'document_id' => $d4->id,
                'reviewer_id' => $reviewer1->id,
                'comment' => "Les effectifs sont trop faibles et plusieurs tests n'ont pas été corrigés pour les comparaisons multiples. Recommandation : refus.",
                'status' => ReviewStatus::Rejected,
            ]);

            $d5 = Document::create([
                'user_id' => $author->id,
                'title' => $demoTitlePrefix.'Publié sur la page d’accueil',
                'abstract' => "Communication courte sur l'accès ouvert aux données de laboratoire : principes, outils et exemples de dépôts institutionnels. Texte utilisé pour la vitrine publique de la plateforme.",
                'file_path' => null,
                'status' => DocumentStatus::Published,
                'published_at' => now()->subDays(10),
            ]);
            $d5->reviewers()->sync([$reviewer1->id, $reviewer2->id]);
            Review::create([
                'document_id' => $d5->id,
                'reviewer_id' => $reviewer1->id,
                'comment' => 'Article clair et utile pour la communauté.',
                'status' => ReviewStatus::Approved,
            ]);
            Review::create([
                'document_id' => $d5->id,
                'reviewer_id' => $reviewer2->id,
                'comment' => 'Je recommande la publication.',
                'status' => ReviewStatus::Approved,
            ]);
        });

        $this->command->info('Données de démo créées (titres commençant par « [Demo] »).');
        $this->command->table(
            ['Compte', 'E-mail', 'Mot de passe'],
            [
                ['Admin', config('scientific-platform.admin_email'), '(ADMIN_PASSWORD ou password)'],
                ['Auteur', config('scientific-platform.author_email'), '(AUTHOR_PASSWORD ou password)'],
                ['Reviewer 1', config('scientific-platform.reviewer_email'), '(REVIEWER_PASSWORD ou password)'],
                ['Reviewer 2', 'reviewer2@scientific-platform.test', 'identique reviewer 1'],
            ]
        );
    }
}
