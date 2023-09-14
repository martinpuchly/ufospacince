<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Nasledujúce jazykové riadky obsahujú predvolené chybové správy používané triedou validátora. Niektoré z týchto pravidiel majú viacero verzií, ako napríklad pravidlá pre veľkosť. Slobodne upravte každú z týchto správ tu.
    |
    */

    'accepted' => 'Pole :attribute musí byť akceptované.',
    'accepted_if' => 'Pole :attribute musí byť akceptované, keď :other je :value.',
    'active_url' => 'Pole :attribute musí byť platnou URL adresou.',
    'after' => 'Pole :attribute musí byť dátumom po :date.',
    'after_or_equal' => 'Pole :attribute musí byť dátumom po alebo rovným :date.',
    'alpha' => 'Pole :attribute musí obsahovať iba písmená.',
    'alpha_dash' => 'Pole :attribute musí obsahovať iba písmená, číslice, pomlčky a podčiarkovníky.',
    'alpha_num' => 'Pole :attribute musí obsahovať iba písmená a číslice.',
    'array' => 'Pole :attribute musí byť pole.',
    'ascii' => 'Pole :attribute musí obsahovať iba jednobajtové alfanumerické znaky a symboly.',
    'before' => 'Pole :attribute musí byť dátumom pred :date.',
    'before_or_equal' => 'Pole :attribute musí byť dátumom pred alebo rovným :date.',
    'between' => [
        'array' => 'Pole :attribute musí obsahovať medzi :min a :max položkami.',
        'file' => 'Pole :attribute musí mať veľkosť medzi :min a :max kilobajtmi.',
        'numeric' => 'Pole :attribute musí byť medzi :min a :max.',
        'string' => 'Pole :attribute musí mať dĺžku medzi :min a :max znakmi.',
    ],
    'boolean' => 'Pole :attribute musí byť true alebo false.',
    'confirmed' => 'Potvrdenie poľa :attribute sa nezhoduje.',
    'current_password' => 'Heslo je nesprávne.',
    'date' => 'Pole :attribute musí byť platný dátum.',
    'date_equals' => 'Pole :attribute musí byť dátumom rovným :date.',
    'date_format' => 'Pole :attribute musí zodpovedať formátu :format.',
    'decimal' => 'Pole :attribute musí mať :decimal desatinných miest.',
    'declined' => 'Pole :attribute musí byť odmietnuté.',
    'declined_if' => 'Pole :attribute musí byť odmietnuté, keď :other je :value.',
    'different' => 'Pole :attribute a :other musia byť rôzne.',
    'digits' => 'Pole :attribute musí mať :digits číslic.',
    'digits_between' => 'Pole :attribute musí mať medzi :min a :max číslicami.',
    'dimensions' => 'Pole :attribute má neplatné rozmery obrázka.',
    'distinct' => 'Pole :attribute obsahuje duplicitnú hodnotu.',
    'doesnt_end_with' => 'Pole :attribute nesmie končiť jedným z nasledujúcich: :values.',
    'doesnt_start_with' => 'Pole :attribute nesmie začínať jedným z nasledujúcich: :values.',
    'email' => 'Pole :attribute musí byť platnou e-mailovou adresou.',
    'ends_with' => 'Pole :attribute musí končiť jedným z nasledujúcich: :values.',
    'enum' => 'Vybraný :attribute je neplatný.',
    'exists' => 'Vybraný :attribute je neplatný.',
    'file' => 'Pole :attribute musí byť súborom.',
    'filled' => 'Pole :attribute musí mať hodnotu.',
    'gt' => [
        'array' => 'Pole :attribute musí obsahovať viac ako :value položiek.',
        'file' => 'Pole :attribute musí mať veľkosť väčšiu ako :value kilobajtov.',
        'numeric' => 'Pole :attribute musí byť väčšie ako :value.',
        'string' => 'Pole :attribute musí mať dĺžku väčšiu ako :value znakov.',
    ],
    'gte' => [
        'array' => 'Pole :attribute musí obsahovať :value alebo viac položiek.',
        'file' => 'Pole :attribute musí mať veľkosť väčšiu alebo rovnakú ako :value kilobajtov.',
        'numeric' => 'Pole :attribute musí byť väčšie alebo rovnaké ako :value.',
        'string' => 'Pole :attribute musí mať dĺžku väčšiu alebo rovnakú ako :value znakov.',
    ],
    'image' => 'Pole :attribute musí byť obrázkom.',
    'in' => 'Vybraný :attribute je neplatný.',
    'in_array' => 'Pole :attribute musí existovať v :other.',
    'integer' => 'Pole :attribute musí byť celé číslo.',
    'ip' => 'Pole :attribute musí byť platnou IP adresou.',
    'ipv4' => 'Pole :attribute musí byť platnou IPv4 adresou.',
    'ipv6' => 'Pole :attribute musí byť platnou IPv6 adresou.',
    'json' => 'Pole :attribute musí byť platným JSON reťazcom.',
    'lowercase' => 'Pole :attribute musí byť malými písmenami.',
    'lt' => [
        'array' => 'Pole :attribute musí obsahovať menej ako :value položiek.',
        'file' => 'Pole :attribute musí mať veľkosť menšiu ako :value kilobajtov.',
        'numeric' => 'Pole :attribute musí byť menšie ako :value.',
        'string' => 'Pole :attribute musí mať dĺžku menšiu ako :value znakov.',
    ],
    'lte' => [
        'array' => 'Pole :attribute nesmie obsahovať viac ako :value položiek.',
        'file' => 'Pole :attribute musí mať veľkosť menšiu alebo rovnakú ako :value kilobajtov.',
        'numeric' => 'Pole :attribute musí byť menšie alebo rovnaké ako :value.',
        'string' => 'Pole :attribute musí mať dĺžku menšiu alebo rovnakú ako :value znakov.',
    ],
    'mac_address' => 'Pole :attribute musí byť platnou MAC adresou.',
    'max' => [
        'array' => 'Pole :attribute nesmie obsahovať viac ako :max položiek.',
        'file' => 'Pole :attribute nesmie mať veľkosť väčšiu ako :max kilobajtov.',
        'numeric' => 'Pole :attribute nesmie byť väčšie ako :max.',
        'string' => 'Pole :attribute nesmie mať dĺžku väčšiu ako :max znakov.',
    ],
    'max_digits' => 'Pole :attribute nesmie mať viac ako :max číslic.',
    'mimes' => 'Pole :attribute musí byť súborom typu: :values.',
    'mimetypes' => 'Pole :attribute musí byť súborom typu: :values.',
    'min' => [
        'array' => 'Pole :attribute musí obsahovať aspoň :min položiek.',
        'file' => 'Pole :attribute musí mať veľkosť aspoň :min kilobajtov.',
        'numeric' => 'Pole :attribute musí byť aspoň :min.',
        'string' => 'Pole :attribute musí mať aspoň :min znakov.',
    ],
    'min_digits' => 'Pole :attribute musí mať aspoň :min číslic.',
    'missing' => 'Pole :attribute musí byť chýbajúce.',
    'missing_if' => 'Pole :attribute musí byť chýbajúce, keď :other je :value.',
    'missing_unless' => 'Pole :attribute musí byť chýbajúce, pokiaľ :other nie je v :values.',
    'missing_with' => 'Pole :attribute musí byť chýbajúce, keď sú prítomné :values.',
    'missing_with_all' => 'Pole :attribute musí byť chýbajúce, keď sú prítomné :values.',
    'multiple_of' => 'Pole :attribute musí byť násobkom :value.',
    'not_in' => 'Vybraný :attribute je neplatný.',
    'not_regex' => 'Formát poľa :attribute je neplatný.',
    'numeric' => 'Pole :attribute musí byť číslo.',
    'password' => [
        'letters' => 'Pole :attribute musí obsahovať aspoň jedno písmeno.',
        'mixed' => 'Pole :attribute musí obsahovať aspoň jedno veľké a jedno malé písmeno.',
        'numbers' => 'Pole :attribute musí obsahovať aspoň jedno číslo.',
        'symbols' => 'Pole :attribute musí obsahovať aspoň jeden symbol.',
        'uncompromised' => 'Uvedený :attribute sa objavil v úniku dát. Prosím, vyberte iný :attribute.',
    ],
    'present' => 'Pole :attribute musí byť prítomné.',
    'prohibited' => 'Pole :attribute je zakázané.',
    'prohibited_if' => 'Pole :attribute je zakázané, keď :other je :value.',
    'prohibited_unless' => 'Pole :attribute je zakázané, pokiaľ :other nie je v :values.',
    'prohibits' => 'Pole :attribute zakazuje :other byť prítomný.',
    'regex' => 'Formát poľa :attribute je neplatný.',
    'required' => 'Pole :attribute je povinné.',
    'required_array_keys' => 'Pole :attribute musí obsahovať položky pre: :values.',
    'required_if' => 'Pole :attribute je povinné, keď :other je :value.',
    'required_if_accepted' => 'Pole :attribute je povinné, keď je :other akceptované.',
    'required_unless' => 'Pole :attribute je povinné, pokiaľ :other nie je v :values.',
    'required_with' => 'Pole :attribute je povinné, keď sú prítomné :values.',
    'required_with_all' => 'Pole :attribute je povinné, keď sú prítomné :values.',
    'required_without' => 'Pole :attribute je povinné, keď nie sú prítomné :values.',
    'required_without_all' => 'Pole :attribute je povinné, keď nie sú prítomné žiadne z :values.',
    'same' => 'Pole :attribute musí byť rovnaké ako :other.',
    'size' => [
        'array' => 'Pole :attribute musí obsahovať :size položiek.',
        'file' => 'Pole :attribute musí mať veľkosť :size kilobajtov.',
        'numeric' => 'Pole :attribute musí mať veľkosť :size.',
        'string' => 'Pole :attribute musí mať dĺžku :size znakov.',
    ],
    'starts_with' => 'Pole :attribute musí začínať jedným z nasledujúcich: :values.',
    'string' => 'Pole :attribute musí byť reťazcom.',
    'timezone' => 'Pole :attribute musí byť platnou časovou zónou.',
    'unique' => ':attribute už bol použitý.',
    'uploaded' => 'Nepodarilo sa nahrať :attribute.',
    'uppercase' => 'Pole :attribute musí byť veľkými písmenami.',
    'url' => 'Pole :attribute musí byť platnou URL adresou.',
    'ulid' => 'Pole :attribute musí byť platným ULID.',
    'uuid' => 'Pole :attribute musí byť platným UUID.',


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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
