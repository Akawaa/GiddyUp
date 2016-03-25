passwords.php<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Le champ doit être accepté.',
    'active_url'           => "L'URL n'est pas valide.",
    'after'                => 'La date doit être supérieure à la date :date.',
    'alpha'                => 'Le champ ne doit contenir que des lettres.',
    'alpha_dash'           => 'Le champ ne doit contenir que des lettres, des nombres, et certains caractères spéciaux.',
    'alpha_num'            => 'Le champ ne doit contenir que des lettres et des nombres.',
    'array'                => 'Le champ doit être un tableau.',
    'before'               => 'La date doit être inférieure à la date :date.',
    'between'              => [
        'numeric' => 'Le champ doit être compris entre :min et :max.',
        'file'    => 'Le champ doit être compris entre :min et :max kilobytes.',
        'string'  => 'Le champ doit être compris entre :min et :max caractères.',
        'array'   => 'Le tableau doit contenir entre :min et :max objets.',
    ],
    'boolean'              => 'Le champ doit être vrai ou faux.',
    'confirmed'            => 'Le champ de confirmation ne correspond pas au mot de passe.',
    'date'                 => "Le champ n'est pas une date valide.",
    'date_format'          => 'Le champ ne correspond pas au :format.',
    'different'            => 'Le champ et le champ :other doivent être différents.',
    'digits'               => 'Le champ doit être un format digital.',
    'digits_between'       => 'Le champ doit être compris entre :min et :max digitals.',
    'email'                => 'Le champ doit être une adresse mail valide.',
    'exists'               => 'Le champ sélectionné est invalide.',
    'filled'               => 'Le champ est requis.',
    'image'                => 'Le champ doit être une image.',
    'in'                   => 'L\'attribut sélectionné est invalide.',
    'integer'              => 'Le champ doit être un entier.',
    'ip'                   => 'Le champ doit être une adresse IP valide.',
    'json'                 => 'Le champ doit être une chaîne JSON valide.',
    'max'                  => [
        'numeric' => 'Le champ ne doit pas être supérieur à :max.',
        'file'    => 'Le champ ne doit pas être supérieur à :max kilobytes.',
        'string'  => 'Le champ ne doit pas être supérieur à :max caractères.',
        'array'   => 'Le tableau doit contenir plus de :max objets.',
    ],
    'mimes'                => 'Le champ doit être un fichier de type: :values.',
    'min'                  => [
        'numeric' => 'Le champ doit être d\'au minimum :min.',
        'file'    => 'Le champ doit être d\'au minimum :min kilobytes.',
        'string'  => 'Le champ doit être d\'au minimum :min caractères.',
        'array'   => 'Le tableau doit contenir au minimum :min objets.',
    ],
    'not_in'               => 'Le champ sélectionné est invalide.',
    'numeric'              => 'Le champ doit être un nombre.',
    'regex'                => 'Le champ est invalide.',
    'required'             => 'Le champ est requis.',
    'required_if'          => 'Le champ est requis quand :other est :value.',
    'required_unless'      => 'Le champ est requis sauf si :other est :values.',
    'required_with'        => 'Le champ est requis quand :values est présent.',
    'required_with_all'    => 'Le champ est requis quand :values est présent.',
    'required_without'     => 'Le champ est requis quand :values n\'est pas présent.',
    'required_without_all' => 'Le champ est requis quand aucun :values est présent.',
    'same'                 => 'Le champ et le champ :other doivent être identiques.',
    'size'                 => [
        'numeric' => 'Le champ doit être :size.',
        'file'    => 'Le champ doit être de :size kilobytes.',
        'string'  => 'Le champ doit avoir :size caractères.',
        'array'   => 'Le tableau doit contenir :size objets.',
    ],
    'string'               => 'Le champ doit être une chaîne de caractères.',
    'timezone'             => 'Le champ doit être une zone valide.',
    'unique'               => 'Le champ doit avoir une valeur unique.',
    'url'                  => 'L\'URL n\'est pas valide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
