<?php
/*---------------------------------------------------------------------------------------------
 * Copyright (c) Microsoft Corporation. All rights reserved.
 *  Licensed under the MIT License. See License.txt in the project root for license information.
 *--------------------------------------------------------------------------------------------*/

namespace Microsoft\PhpParser;

class ResolvedName {
    private $parts = [];

    /**
     * @param array | Token[] $tokens
     */
    public static function buildName(array $tokens, $content) : ResolvedName {
        $name = new ResolvedName();
        foreach ($tokens as $token) {
            if ($token->kind === TokenKind::Name) {
                $name->parts[] = $token->getText($content);
            }
        }
        return $name;
    }

    public function addNameParts(array $parts, $content) {
        foreach ($parts as $part) {
            if (!($part instanceof MissingToken) && $part->kind === TokenKind::Name) {
                $this->parts[] = $part->getText($content);
            }
        }
    }

    public function getNameParts() {
        return $this->parts;
    }

    public function getFullyQualifiedNameText() : string {
        return "\\" . join("\\", $this->parts);
    }
}