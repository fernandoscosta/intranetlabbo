<?PHP
$this->Html->addCrumb('Voc� est� aqui:');
$this->Html->addCrumb('<span class="icon16 icomoon-icon-screen-2"></span>', Router::url('/', true), array('escape'=>false, 'title'=>'Voltar para o in�cio', 'class' => 'tip'));

$this->Html->addCrumb( $title_for_layout, $base_url  );
?>
<div class="row-fluid">
    <div class="span12">
        <div class="box gradient">
            <div class="title clearfix">
                <h4 class="left">
                    <span class="icon16 icomoon-icon-table "></span>
                    <span>Lista</span>
                </h4>
            </div>
                <div class="content">
                    <?PHP echo $this->Session->flash(); ?>                          
                    
                    <?PHP
                    echo $this->Form->create("Filter", array(
                                'url' => array('controller'=>'usuarios', 'action'=>'ramais'),
                                'inputDefaults' => array(
                                    'format' => array('label', 'input'),
                                    'div' => false,
                                    'autocomplete'=>'off'
                                )
                    ));
                    ?>
                                        
                    
                    <?PHP echo $this->element('header_listagem'); ?>                    
                    <table class="table table-bordered">
                        <thead>
                          <tr class="head-table">
                                <th><?php echo __('Foto'); ?></th>
                                <th><?PHP echo $this->Paginator->sort('nome', 'Nome<span class="order"></span>', array('escape' => false)); ?></th>
                                <th><?PHP echo $this->Paginator->sort('email', 'Email<span class="order"></span>', array('escape' => false)); ?></th>
                                <th><?php echo __('Grupos'); ?></th>
                                <th><?PHP echo $this->Paginator->sort('ramal', 'Ramal<span class="order"></span>', array('escape' => false)); ?></th>
                            </tr>                    
                            <tr class="filter">
                                <th>&nbsp;</th>
                        	    <th><?PHP echo $this->Form->input('nome', array('label'=>false)); ?></th>
                        	    <th><?PHP echo $this->Form->input('email', array('label'=>false, 'type'=>'text')); ?></th>
                        	    <th><?PHP echo $this->Form->input('grupo', array('label'=>false, 'empty' => '')); ?></th>
                        	    <th><?PHP echo $this->Form->input('ramal', array('label'=>false)); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                    
        <?php foreach ($usuarios as $usuario): ?>
	<tr>
		<td style="text-align: center; min-width: 70px;">
            <?php
            $img = (($usuario['Usuario']['foto']<>'')?'/files/usuario/foto/'.$usuario['Usuario']['foto']:'/img/logo.png');
            echo $this->Timthumb->image($img, array('width' => 50, 'height' => 50, 'zoom_crop'=> 2), array('class'=>'image'));
            ?>&nbsp;
        </td>
		<td><?php echo $this->Html->link( $usuario['Usuario']['nome'] , array('controller' => 'usuarios' , 'action' => 'perfil', $usuario['Usuario']['id']), array('title'=>'Perfil')); ?>&nbsp;</td>
		<td><?php echo h($usuario['Usuario']['email']); ?>&nbsp;</td>
		<td><?php foreach($usuario['Grupos'] as $grupo) { echo $grupo['titulo'] . ', '; } ?>&nbsp;</td>
		<td><?php echo h($usuario['Usuario']['ramal']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
                    
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">                  
                                    <div class="pagination">
                                        <span class="span6"><?PHP echo $this->Paginator->counter(array('format' => 'Exibindo {:start} at� {:end} do total de {:count}')); ?></span>
                                        <span class="span6">
                                            <div class="right">
                                                <ul>
                                                    <?php
                                                    echo $this->Paginator->first( '&laquo;', array('tag' => 'li', 'class'=> 'first', 'escape'=>false), null, array('class' => 'disabled first', 'tag' => 'li', 'escape'=>false));
                                                    echo $this->Paginator->prev( '&lsaquo;', array('tag' => 'li', 'escape'=>false), null, array('class' => 'disabled', 'tag' => 'li', 'escape'=>false));
                                                    
                                                    echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active','tag' => 'li'));
                                                    
                                                    echo $this->Paginator->next( '&rsaquo;', array('tag' => 'li', 'escape'=>false), null, array('class' => 'disabled','tag' => 'li', 'escape'=>false));
                                                    echo $this->Paginator->last( '&raquo;', array('tag' => 'li', 'class'=>'last', 'escape'=>false), null, array('class' => 'disabled last', 'tag' => 'li', 'escape'=>false));
                                                    ?>
                                                </ul>
                                            </div>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                        
                    </table>
                    <?PHP echo $this->Form->end(); ?>   
                </div>
            </div><!-- End .box -->
        </div><!-- End .span6 -->
</div>