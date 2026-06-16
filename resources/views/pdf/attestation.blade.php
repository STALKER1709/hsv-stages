<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Attestation de Stage</title>
    <style>
        @page { margin: 1cm; }
        body { font-family: 'DejaVu Sans', Arial, sans-serif; background: white; color: #1e293b; margin: 0; padding: 0; }
        .page { width: 100%; min-height: 180mm; border: 3px solid #10b981; padding: 30px; box-sizing: border-box; position: relative; }
        .header { text-align: center; border-bottom: 2px solid #10b981; padding-bottom: 20px; margin-bottom: 25px; }
        .logo { font-size: 28px; font-weight: bold; color: #10b981; margin-bottom: 5px; }
        .subtitle { font-size: 12px; color: #64748b; }
        .title { font-size: 20px; font-weight: bold; text-align: center; text-transform: uppercase; letter-spacing: 3px; color: #1e3a5f; margin: 20px 0; }
        .body-text { font-size: 13px; line-height: 1.8; text-align: justify; margin: 15px 0; }
        .name { font-size: 22px; font-weight: bold; color: #10b981; text-align: center; margin: 15px 0; }
        .pole { font-size: 16px; font-weight: bold; text-align: center; color: #1e3a5f; margin: 10px 0; }
        .info-grid { display: flex; justify-content: space-between; margin: 20px 0; }
        .info-item { text-align: center; }
        .info-label { font-size: 10px; color: #64748b; text-transform: uppercase; letter-spacing: 1px; }
        .info-value { font-size: 13px; font-weight: bold; color: #1e293b; margin-top: 3px; }
        .signature { margin-top: 30px; display: flex; justify-content: space-between; }
        .sig-block { text-align: center; width: 45%; }
        .sig-line { border-bottom: 1px solid #94a3b8; margin-bottom: 8px; height: 40px; }
        .sig-label { font-size: 11px; color: #64748b; }
        .watermark { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(-30deg); font-size: 80px; font-weight: bold; color: rgba(16,185,129,0.05); white-space: nowrap; pointer-events: none; }
        .badge { display: inline-block; background: #10b981; color: white; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: bold; margin: 5px; }
        .footer { text-align: center; margin-top: 20px; padding-top: 15px; border-top: 1px solid #e2e8f0; font-size: 10px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="page">
        <div class="watermark">HSV STAGES</div>
        <div class="header">
            <div class="logo">HSV STAGES</div>
            <div class="subtitle">Plateforme de Stages Académiques en Informatique — Cameroun</div>
        </div>
        <div class="title">Attestation de Stage</div>
        <div class="body-text">
            Nous soussignés, la direction de <strong>HSV Stages</strong>, certifions par la présente que :
        </div>
        <div class="name">{{ strtoupper($stagiaire->user->name) }}</div>
        <div class="body-text" style="text-align: center; color: #64748b;">
            Étudiant(e) en <strong>{{ $stagiaire->filiere }}</strong> — Niveau <strong>{{ $stagiaire->niveau }}</strong><br>
            <em>{{ \App\Models\Stagiaire::ETABLISSEMENTS[$stagiaire->etablissement] ?? $stagiaire->etablissement }}</em>
        </div>
        <div class="body-text" style="margin-top: 20px;">
            a effectué avec succès un stage académique au sein de notre programme HSV Stages, dans le pôle :
        </div>
        <div class="pole">{{ $stagiaire->pole->nom }}</div>
        <div class="body-text">
            Ce stage d'une durée de <strong>3 mois</strong> (juillet — septembre 2025) a permis à l'intéressé(e) d'acquérir des compétences pratiques en informatique, de travailler sur des projets concrets et de développer un esprit professionnel.
        </div>
        <div style="text-align: center; margin: 15px 0;">
            <span class="badge">Formation complétée</span>
            <span class="badge">Évaluations réussies</span>
        </div>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Date d'émission</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($attestation->date_emission)->format('d/m/Y') }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Délivré par</div>
                <div class="info-value">{{ $attestation->delivre_par }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Référence</div>
                <div class="info-value">HSV-2025-{{ str_pad($stagiaire->id, 4, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>
        <div class="signature">
            <div class="sig-block">
                <div class="sig-line"></div>
                <div class="sig-label">Signature du stagiaire</div>
            </div>
            <div class="sig-block">
                <div class="sig-line"></div>
                <div class="sig-label">Le Coordinateur — HSV Stages</div>
            </div>
        </div>
        <div class="footer">
            Ce document est délivré à titre d'attestation et fait foi de la participation effective au programme HSV Stages 2025.<br>
            Yaoundé, Cameroun | contact@hsv-stages.cm
        </div>
    </div>
</body>
</html>
