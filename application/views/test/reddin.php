            <div class="row-fluid">
                <div class="span12">
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i><?php echo $titulo; ?></h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                        
                        <?php if($control == 1){?>
                        
                        <h2>Este test ya fue contestado; Gracias.</h2>
                        
                        <?php
                        
                        }else{
                        
                        ?>
                        
                        <?php
                        
                        echo form_open('test/reddin_serie', array('class' => 'form-horizontal'));
                        
                        echo utf8_encode('
                        
                        
                        <p class="text-info">
                        INSTRUCCIONES
                        <br /><br />
                        Este ejercicio consta de dos partes: Una hoja de respuestas y un cuestionario con 64 pares de afirmaciones.<br /> 
                        La hoja de respuestas tiene un cuadro dividido en 64 casillas numeradas en las que deber&aacute; anotar su elecci�n de cada par de afirmaciones del cuestionario.
                        <br />
                        Lea las afirmaciones de cada par que aparece en el cuestionario y seleccione una de ellas. 
                        Si usted cree que la primera afirmaci�n es la que est� m�s de acuerdo con su forma de ser en el trabajo, ponga la letra �A� en el cuadro que tiene el mismo n�mero del par de afirmaciones que esta leyendo. 
                        Si por el contrario, la segunda afirmaci�n es la que lo describe mejor, ponga la letra �B� en el cuadro correspondiente.
                        <br /><br />
                        
                        Ejemplo:
                        <br />
                        El primer par de afirmaciones es:
                        <br />
                        A)	No pone atenci�n a violaciones de reglas, si est� seguro que nadie m�s sabe que �stas se cometen.
                        <br />
                        B)	Cuando comunica una decisi�n que no es bien acogida explica a sus subordinados que fue su jefe quien la tom�.
                        <br /><br />
                        
                        
                        
                        Si piensa que la afirmaci�n �A� describe mejor su comportamiento que la �B�, escriba la letra �A� en el cuadro se�alado con el n�mero uno. 
                        Si la �B� es la que mejor lo describe, deber� escribir la letra �B� en el cuadro n�mero uno. 
                        Para decidir cual afirmaci�n describe mejor su comportamiento, preg�ntese cu�l describe su forma de ser actual en el trabajo. 
                        Algunas afirmaciones parecen ambiguas, en ocasiones podr�a aplicarse las dos y en otras ninguna. 
                        Sin embargo, en cada caso elija la afirmaci�n que mejor lo describe actualmente, si usted estuviera en estas circunstancias. 
                        No deje de contestar ning�n par de afirmaciones y se�ale s�lo una para cada cuadro.

                        </p>
                        ');
                        
                         ?>   
                        <div class="form-actions">
                        
                            <button class="btn blue" type="submit">
                                <i class="icon-ok"></i>
                        
                                 Iniciar
                        
                            </button>
                        
                        </div>
                        
                        <?php
                        
                        echo form_close();
                        
                        }
                        
                        ?>
                        
                        </div>
                    </div>
                </div>
            </div>
                        