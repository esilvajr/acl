<?php

namespace Acl\i18n;

class Translate
{
    const EN = 'en';
    const BR = 'pt-BR';

    const ROLE_ALREADY_EXISTS = [
        self::EN => 'Role "%s" already exists in the registry.',
        self::BR => 'O papel "%s" já existe nos registros.'
    ];
    const ACL_EMPTY_USER = [
        self::EN => 'User is not set.',
        self::BR => 'Usuário não configurado.'
    ];
}
