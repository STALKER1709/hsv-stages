<x-mail::message>
# Bienvenue chez HSV Stages !

Bonjour {{ $stagiaire->user->name }},

Votre inscription au stage a bien été enregistrée. Voici un récapitulatif :

- **Pôle :** {{ $stagiaire->pole->nom }}
- **Établissement :** {{ $stagiaire->etablissement }}
- **Niveau :** {{ $stagiaire->niveau }}

Votre dossier est en attente de validation. Vous serez notifié(e) dès que votre paiement aura été vérifié.

Connectez-vous avec votre email et le mot de passe = les 6 derniers chiffres de votre numéro de téléphone.

<x-mail::button :url="route('login')">
Se connecter
</x-mail::button>

Une question ? Contactez-nous sur WhatsApp : {{ config('services.contact.whatsapp_number') }}

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
