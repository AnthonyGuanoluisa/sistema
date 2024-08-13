<?php

declare (strict_types=1);
namespace Rector\DowngradePhp73\Rector\FuncCall;

use PhpParser\Node;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\Instanceof_;
use PhpParser\Node\Name\FullyQualified;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @changelog https://wiki.php.net/rfc/is-countable
 *
 * @see \Rector\Tests\DowngradePhp73\Rector\FuncCall\DowngradeIsCountableRector\DowngradeIsCountableRectorTest
 */
final class DowngradeIsCountableRector extends \Rector\Core\Rector\AbstractRector
{
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Downgrade is_countable() to former version', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample(<<<'CODE_SAMPLE'
$items = [];
return is_countable($items);
CODE_SAMPLE
, <<<'CODE_SAMPLE'
$items = [];
return is_array($items) || $items instanceof Countable;
CODE_SAMPLE
)]);
    }
    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes() : array
    {
        return [\PhpParser\Node\Expr\FuncCall::class];
    }
    /**
     * @param FuncCall $node
     */
    public function refactor(\PhpParser\Node $node) : ?\PhpParser\Node
    {
        if (!$this->isName($node, 'is_countable')) {
            return null;
        }
        $isArrayFuncCall = $this->nodeFactory->createFuncCall('is_array', $node->args);
        $instanceof = new \PhpParser\Node\Expr\Instanceof_($node->args[0]->value, new \PhpParser\Node\Name\FullyQualified('Countable'));
        return new \PhpParser\Node\Expr\BinaryOp\BooleanOr($isArrayFuncCall, $instanceof);
    }
}
