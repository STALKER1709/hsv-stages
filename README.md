# StagesPro Cameroun

Plateforme e-learning pour le **Programme d'Accueil de Stagiaires Académiques en Informatique** — Session Juillet–Septembre.

## Stack technique

- **Frontend** : HTML5 + Tailwind CSS (CDN) + Alpine.js + Font Awesome
- **Backend prévu** : Laravel 11 (PHP 8.3)
- **Base de données** : MySQL 8
- **Cache / Queue** : Redis
- **Déploiement** : Docker + Nginx + Supervisor

---

## Pages disponibles

| Page | Rôle | Fichier |
|------|------|---------|
| Accueil | Public | `public/index.html` |
| Programme | Public | `public/programme.html` |
| Inscription | Public | `public/inscription.html` |
| Connexion | Tous | `public/login.html` |
| Dashboard stagiaire | Stagiaire | `public/dashboard-stagiaire.html` |
| Mon Parcours | Stagiaire | `public/parcours.html` |
| Cours / Leçon | Stagiaire | `public/cours-detail.html` |
| Évaluation QCM | Stagiaire | `public/evaluation.html` |
| Profil | Stagiaire | `public/profil-stagiaire.html` |
| Attestation | Stagiaire | `public/attestation.html` |
| Dashboard encadreur | Encadreur | `public/dashboard-encadreur.html` |
| Mes stagiaires | Encadreur | `public/mes-stagiaires.html` |
| Gestion cours | Encadreur | `public/gestion-cours.html` |
| Présences | Encadreur | `public/presences.html` |
| Dashboard admin | Admin | `public/dashboard-admin.html` |
| Gestion stagiaires | Admin | `public/gestion-stagiaires.html` |
| Gestion encadreurs | Admin | `public/gestion-encadreurs.html` |
| Budget | Admin | `public/budget.html` |
| Rapports & Exports | Admin | `public/rapports.html` |

---

## Déploiement rapide (Docker)

### Prérequis
- Ubuntu 20.04+ ou Debian 11+
- Docker + Docker Compose installés
- Git

### Étapes

```bash
# 1. Cloner le projet
git clone https://github.com/stalker1709/hsv-stages.git
cd hsv-stages

# 2. Configurer l'environnement
cp deploy/.env.example .env
# Éditer .env : remplir DB_PASSWORD, APP_KEY, etc.

# 3. Déployer
chmod +x deploy/deploy.sh
bash deploy/deploy.sh production --seed

# 4. Accéder à l'application
# http://VOTRE_IP
```

---

## Comptes de test

| Rôle | Email | Mot de passe |
|------|-------|--------------|
| Stagiaire | stagiaire@test.cm | password |
| Encadreur | encadreur@test.cm | password |
| Admin | admin@test.cm | password |

---

## Contexte local Cameroun

- Paiement : **Orange Money** (#144#) et **MTN MoMo** (*126#)
- Établissements : IAI Cameroun, ISSAM, Université SIANTOU, ISESTMA
- Contribution : **50 000 FCFA** par stagiaire · Session **Juillet – Septembre**
- Interface entièrement en **français**, design **mobile-first**

---

© 2025 StagesPro Cameroun