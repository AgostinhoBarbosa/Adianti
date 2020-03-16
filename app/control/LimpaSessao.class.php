<?php

    use Adianti\Registry\TSession;

    class LimpaSessao extends TElement
    {
        public function __construct( $param )
        {
            self::limpar( $param );
        }

        public static function Limpar( $param )
        {
            $modelo     = str_replace( 'List', '', $param[ 'modelo' ] );
            $modelo     = str_replace( 'Form', '', $modelo );
            $modelo     = str_replace( 'View', '', $modelo );
            $classe     = $param[ 'modelo' ];
            $formulario = $modelo;
            if ( class_exists( $classe ) ) {
                $form = new $classe();
                if ( method_exists( $form, 'getActiveRecord' ) ) {
                    $formulario = $form->getactiveRecord();
                }
            }

            if ( ! empty( $modelo ) || ( ! empty( $formulario ) ) ) {

                foreach ( $_SESSION[ APPLICATION_NAME ] as $key => $value ) {
                    $pos = strpos( strtolower( $key ), strtolower( $modelo ) );
                    if ( $pos > -1 ) {
                        TSession::delValue( $key );
                    }
                    if ( $formulario ) {
                        $pos = strpos( strtolower( $key ), strtolower( $formulario ) );
                        if ( $pos > -1 ) {
                            TSession::delValue( $key );
                        }
                    }
                }
            }
        }
    }

