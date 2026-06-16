<?php
namespace Database\Seeders;
use App\Models\Pole;
use App\Models\Module;
use App\Models\Lecon;
use App\Models\Evaluation;
use App\Models\Question;
use App\Models\Reponse;
use Illuminate\Database\Seeder;

class PoleSeeder extends Seeder
{
    public function run(): void
    {
        $poles = [
            [
                'nom' => 'Génie Logiciel',
                'description' => 'Développement d\'applications web et mobiles avec les technologies modernes.',
                'couleur' => '#10b981',
                'modules' => [
                    ['titre' => 'Fondamentaux du développement web', 'description' => 'HTML, CSS, JavaScript et bases du web', 'ordre' => 1, 'duree_semaines' => 2],
                    ['titre' => 'Laravel & PHP Avancé', 'description' => 'Framework Laravel, ORM Eloquent, API REST', 'ordre' => 2, 'duree_semaines' => 3],
                    ['titre' => 'React & Vue.js', 'description' => 'Frameworks JavaScript modernes', 'ordre' => 3, 'duree_semaines' => 2],
                    ['titre' => 'Bases de données & SQL', 'description' => 'MySQL, PostgreSQL, optimisation', 'ordre' => 4, 'duree_semaines' => 2],
                    ['titre' => 'Git & DevOps', 'description' => 'Versioning, CI/CD, déploiement', 'ordre' => 5, 'duree_semaines' => 1],
                ],
            ],
            [
                'nom' => 'Systèmes & Réseaux',
                'description' => 'Administration des systèmes Linux, réseaux et infrastructure cloud.',
                'couleur' => '#3b82f6',
                'modules' => [
                    ['titre' => 'Linux & Administration système', 'description' => 'Commandes Linux, gestion utilisateurs, scripts bash', 'ordre' => 1, 'duree_semaines' => 2],
                    ['titre' => 'Réseaux TCP/IP', 'description' => 'Protocoles, routage, switching', 'ordre' => 2, 'duree_semaines' => 2],
                    ['titre' => 'Sécurité informatique', 'description' => 'Cybersécurité, firewall, VPN', 'ordre' => 3, 'duree_semaines' => 2],
                    ['titre' => 'Virtualisation & Cloud', 'description' => 'Docker, Kubernetes, AWS basics', 'ordre' => 4, 'duree_semaines' => 3],
                    ['titre' => 'Monitoring & Supervision', 'description' => 'Zabbix, Grafana, alerting', 'ordre' => 5, 'duree_semaines' => 1],
                ],
            ],
            [
                'nom' => 'Software Engineering',
                'description' => 'Méthodes agiles, architecture logicielle et gestion de projets IT.',
                'couleur' => '#8b5cf6',
                'modules' => [
                    ['titre' => 'Méthodes Agile & Scrum', 'description' => 'Sprints, user stories, backlog', 'ordre' => 1, 'duree_semaines' => 1],
                    ['titre' => 'Architecture logicielle', 'description' => 'Design patterns, MVC, microservices', 'ordre' => 2, 'duree_semaines' => 2],
                    ['titre' => 'Tests & Qualité', 'description' => 'TDD, tests unitaires, intégration', 'ordre' => 3, 'duree_semaines' => 2],
                    ['titre' => 'Gestion de projet IT', 'description' => 'Planification, risques, livrables', 'ordre' => 4, 'duree_semaines' => 2],
                    ['titre' => 'Documentation & Communication', 'description' => 'Rédaction technique, présentations', 'ordre' => 5, 'duree_semaines' => 1],
                ],
            ],
        ];

        foreach ($poles as $poleData) {
            $modulesData = $poleData['modules'];
            unset($poleData['modules']);
            $pole = Pole::create($poleData);

            foreach ($modulesData as $moduleData) {
                $module = Module::create(array_merge($moduleData, ['pole_id' => $pole->id]));

                // Create 2 sample lecons per module
                for ($i = 1; $i <= 2; $i++) {
                    Lecon::create([
                        'module_id'       => $module->id,
                        'titre'           => "Leçon $i : " . $module->titre,
                        'contenu'         => "<h2>Introduction</h2><p>Contenu de la leçon $i pour le module {$module->titre}.</p><h3>Objectifs</h3><ul><li>Comprendre les concepts de base</li><li>Appliquer les connaissances</li></ul>",
                        'duree_minutes'   => 45,
                        'ordre'           => $i,
                    ]);
                }

                // Create 1 evaluation per module
                $eval = Evaluation::create([
                    'module_id'  => $module->id,
                    'titre'      => 'Évaluation : ' . $module->titre,
                    'duree_minutes' => 30,
                    'note_max'   => 20,
                ]);

                // 3 questions per evaluation
                $questionsData = [
                    ['texte' => "Quelle est la définition principale de {$module->titre} ?", 'reponses' => ['Définition A (correcte)', 'Définition B', 'Définition C', 'Définition D'], 'correcte' => 0],
                    ['texte' => "Quel outil est principalement utilisé en {$module->titre} ?", 'reponses' => ['Outil A', 'Outil B (correct)', 'Outil C', 'Outil D'], 'correcte' => 1],
                    ['texte' => "Quelle bonne pratique est recommandée en {$module->titre} ?", 'reponses' => ['Pratique A', 'Pratique B', 'Pratique C (correcte)', 'Pratique D'], 'correcte' => 2],
                ];
                foreach ($questionsData as $idx => $qData) {
                    $question = Question::create(['evaluation_id' => $eval->id, 'texte' => $qData['texte'], 'ordre' => $idx + 1]);
                    foreach ($qData['reponses'] as $ri => $rtexte) {
                        Reponse::create(['question_id' => $question->id, 'texte' => $rtexte, 'est_correcte' => $ri === $qData['correcte']]);
                    }
                }
            }
        }
    }
}
