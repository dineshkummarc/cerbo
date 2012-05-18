<?php

class TwigNina_DesignNecessite_TokenParser extends Twig_TokenParser
{
    public function parse( Twig_Token $token )
    {

        $lineno = $token->getLine();
        $value = $this->parser->getExpressionParser()->parseExpression();
        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

        return new TwigNina_DesignNecessite_Node( null, $value, $lineno, $this->getTag() );

    }

    public function getTag()
    {
        return 'design_necessite';
    }
}

class TwigNina_DesignNecessite_Node extends Twig_Node
{

    public function __construct( $name, Twig_Node_Expression $value, $lineno, $tag = null )
    {
        parent::__construct( array( 'value' => $value ), array( 'name' => $name ), $lineno, $tag );
    }

    public function compile( Twig_Compiler $compiler )
    {
        global $_DESIGN;
        foreach ( $this->getNode( 'value' )->getKeyValuePairs() as $fichier )
        {
            $_DESIGN[] = $fichier['value']->getAttribute( 'value' );
        }
    }

}

?>
