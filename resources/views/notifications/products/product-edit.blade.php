@component('mail::message')
# Du nouveau sur Shop !

Un nouveau produit vient d'être ajouté sur votre plateforme Shop !
N'hésitez pas à le consulter en cliquant sur le bouton ci-dessous:

@component('mail::button', ['url' => url('products')])
Voir le produit
@endcomponent

Merci d'avoir choisi Shop pour votre shopping !<br><br>
{{ config('app.name') }}
@endcomponent