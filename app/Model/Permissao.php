<?php
App::uses('AppModel', 'Model');
/**
 * Permissao Model
 *
 * @property Usuario $Usuario
 * @property Criou $Criou
 */
class Permissao extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'usuario_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser num�rico.',
			),
		),
		'criou_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser num�rico.',
			),
		),
		'id_registro' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser num�rico.',
			),
		),
		'model_registro' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'N�o pode ser vazio.',
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Criou' => array(
			'className' => 'Usuario',
			'foreignKey' => 'criou_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    
    public function savePermission($data, $model, $id_registry) {
        if ( isset( $data['Permissao'] ) ) {                          
            $arr_users = array();
            $id_logged = CakeSession::read("Auth.User.id");
    
            /** Limpa array Ids */
            if (is_array($data['Permissao']['usuario_id'])) {
                foreach( $data['Permissao']['usuario_id'] as $userId ) {
                    if (!in_array($userId, $arr_users)) { $arr_users[] = $userId; }
                }
            }
            
            /** Remove os antigos */
            /*$lista = $this->find('list', array('conditions'=>array(
                'model_registro' => $model,
                'id_registro' => $id_registry             
            ) ));*/
            $this->deleteAll(
                array(
                    'model_registro' => $model,
                    'id_registro' => $id_registry             
                ), false
            );
        
            if (count($arr_users)>0) {
                foreach( $arr_users as $userId ) {
                    $data_permissao = array('Permissao' => array(
                        'id' => NULL,
                        'model_registro' => $model,
                        'id_registro' => $id_registry,
                        'usuario_id' => $userId,
                        'criou_id' => $id_logged,
                    ));
                    
                    $this->create();
                    if ( ! $this->save( $data_permissao ) ) {
                        $this->error_message = 'N�o foi poss�vel gravar permiss�o.';
                    }
                }
            }
        }
    }
    
    
    public function getPermissionList($model, $arr_conditions = array()) {
        $lista = $this->find('list', array(
            'fields' => 'id_registro',
            'group' => 'id_registro',            
            'conditions'=>array(
                'model_registro' => $model,
                $arr_conditions
            )
        ));
        return $lista;
    }
    
    
}
