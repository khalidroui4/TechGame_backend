<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouveau Message de Contact</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .header { background: #020c06; color: #39ff14; padding: 15px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { padding: 20px; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #555; }
        .value { background: #f9f9f9; padding: 10px; border-left: 4px solid #39ff14; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header" style="display: flex; align-items: center; justify-content: center; gap: 10px;">
            <img src="{{ $message->embed(public_path('circle_icon.png')) }}" alt="TechGame Logo" style="width: 32px; height: 32px; object-fit: contain; vertical-align: middle;">
            <h2 style="display: inline-block; margin: 0; vertical-align: middle;">TECHGAME</h2>
        </div>
        <div class="content">
            <p>Vous avez reçu un nouveau message depuis le formulaire de contact.</p>
            
            <div class="field">
                <div class="label">Nom :</div>
                <div class="value">{{ $data['name'] }}</div>
            </div>
            
            <div class="field">
                <div class="label">E-mail :</div>
                <div class="value"><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></div>
            </div>
            
            <div class="field">
                <div class="label">Message :</div>
                <div class="value">{{ nl2br(e($data['message'])) }}</div>
            </div>
        </div>
    </div>
</body>
</html>
