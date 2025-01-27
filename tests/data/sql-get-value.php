<?php

namespace RexSqlGetValue;

use rex;
use rex_sql;
use function PHPStan\Testing\assertType;

function preparedQuery(int $id): void
{
    $sql = rex_sql::factory();
    $sql->setQuery('
            SELECT  name
            FROM    ' . rex::getTable('article') . '
            WHERE   id = ?
            LIMIT   1
        ', [$id]);

    assertType('string', $sql->getValue('name'));
}

function regularQuery(): void
{
    $sql = rex_sql::factory();
    $sql->setQuery('
            SELECT  name
            FROM    ' . rex::getTable('article') . '
            WHERE   id = 1
            LIMIT   1
        ');

    assertType('string', $sql->getValue('name'));
}

function unknownValue(): void
{
    $sql = rex_sql::factory();
    $sql->setQuery('
            SELECT  name
            FROM    ' . rex::getTable('article') . '
            WHERE   id = 1
            LIMIT   1
        ');

    assertType('bool|float|int|string|null', $sql->getValue('doesNotExist'));
    $sql->getDateTimeValue('doesNotExist');
    $sql->getArrayValue('doesNotExist');
}

function tableNamePrefix(): void
{
    $sql = rex_sql::factory();
    $sql->setQuery('
            SELECT  name
            FROM    ' . rex::getTable('article') . '
            WHERE   id = 1
            LIMIT   1
        ');

    assertType('string', $sql->getValue('rex_article.name'));
}

function tableNamePrefix(): void
{
    $sql = rex_sql::factory();
    $sql->setQuery('
            SELECT  name
            FROM    ' . rex::getTablePrefix() . 'article
            WHERE   id = 1
            LIMIT   1
        ');
    assertType('string', $sql->getValue('rex_article.name'));
}
