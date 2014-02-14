<?php
App::uses('AppModel', 'Model');
App::uses('BrValidation', 'Localized.Validation');
/**
 * Usuario Model
 *
 * @property Comentario $Comentario
 * @property Grupo $Grupo
 * @property Cotacao $Cotacao
 * @property Cotacao $Comprador
 * @property Grupo $Grupo
 */
class Usuario extends AppModel {
    
    public $actsAs = array(
        'Upload.Upload' => array(
            'foto' => array(
                'path'=>'{ROOT}webroot{DS}files{DS}{model}{DS}foto{DS}',
                'pathMethod'=>'flat',
                'customName' => '{!getNewName}'
            ),
            'assinatura' => array(
                'path'=>'{ROOT}webroot{DS}files{DS}{model}{DS}assinatura{DS}',
                'pathMethod'=>'flat',
                'customName' => '{!getNewName}'
            ),
        )
    );
	public $displayField = 'nome';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
        'status' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'N�o pode ser vazio.',
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser num�rico.',
			),
		),
        'nivel_id' => array(
			'role' => array(
				'rule' => array('verifyRole'),
				'message' => 'Usu�rio � gerente de algum grupo.',
			),
		),
		'login' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'N�o pode ser vazio.',
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Este login j� est� cadastrado.',
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Necess�rio e-mail v�lido.',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'N�o pode ser vazio.',
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Este e-mail j� est� cadastrado.',
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'N�o pode ser vazio.',
                'on'         => 'create'
			),
			'minlength' => array(
				'rule' => array('minlength', 5),
				'message' => 'No m�nimo 5 caracteres.',
                'on'         => 'create',
			),
		),
		'nome' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'N�o pode ser vazio.',
			),
		),
		'nascimento' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'Necess�rio data v�lida.',
                'allowEmpty' => true,
			),
		),
        'cep' => array(
            'valid' => array(
                'rule' => array('postal', null, 'br'),
                'message' => 'Necess�rio Cep v�lido.',
                'allowEmpty' => true,
            )
        ),
        'cpf' => array(
            'valid' => array(
                'rule' => array('ssn', null, 'br'),
                'message' => 'Necess�rio CPF v�lido.',
                'allowEmpty' => true,
            )
        ),
        'celular' => array(
            'valid' => array(
                'rule' => array('phone', null, 'br'),
                'message' => 'Necess�rio telefone v�lido.',
                'allowEmpty' => true,
            )
        ),
        'telefone' => array(
            'valid' => array(
                'rule' => array('phone', null, 'br'),
                'message' => 'Necess�rio telefone v�lido.',
                'allowEmpty' => true,
            )
        ),
		'foto' => array(
			'notempty' => array(
				'rule' => array('isValidExtension', array('jpg', 'gif', 'png'), false),
                'message' => 'Extens�o inv�lida',
                'on' => 'create'
			),
            
		),
		'assinatura' => array(
			'notempty' => array(
				'rule' => array('isValidExtension', array('jpg', 'gif', 'png'), false),
                'message' => 'Extens�o inv�lida',
                'on' => 'create'
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
		'Nivel' => array(
			'className' => 'Nivel',
			'foreignKey' => 'nivel_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Gerencia' => array(
			'className' => 'Grupo',
			'foreignKey' => 'usuario_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
        /*
		'Comentario' => array(
			'className' => 'Comentario',
			'foreignKey' => 'usuario_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Vendedor' => array(
			'className' => 'Cotacao',
			'foreignKey' => 'vendedor_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Comprador' => array(
			'className' => 'Cotacao',
			'foreignKey' => 'cliente_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
        */
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Grupos' => array(
			'className' => 'Grupo',
			'joinTable' => 'grupos_usuarios',
			'foreignKey' => 'usuario_id',
			'associationForeignKey' => 'grupo_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
    
    
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
   
    public function verifyRole($check) {
        $usuario = $this->find('all', array('limit'=>1, 'conditions'=> array('Usuario.id'=> $this->data['Usuario']['id'] )));
        return ( ! (($check['nivel_id']<>2)&&(count($usuario)>0)&&(count($usuario[0]['Gerencia'])>0)));
    }   
    
    public function verificaPermissao($model = null, $id_registry = null, $id_criador = null, $edit=true) {
        if ( (!empty($model)) && (!empty($id_registry))  && (!empty($id_criador)) ) {
            
            $Permissao = ClassRegistry::init('Permissao');
            $Permissao = new Permissao();
            
            $user = CakeSession::read("Auth.User");
            
            $arr_users_group = $this->Gerencia->listUserGroup( $user['id'] ); // Usu�rios dos Grupos que sou gerente
            $arr_me_permissions = $Permissao->getPermissionList( $model, array('usuario_id' => $user['id'] ) ); // Permiss�o do usu�rio
            
            
            if (($id_criador == $user['id']) // Eu que criei
                 || ((in_array($id_registry, $arr_me_permissions))&&$edit) // Se eu tenho permiss�o
                 || (in_array($id_criador, $arr_users_group)) // Usu�rios do meu grupo criaram
                 
                 || ($user['nivel_id']==1) // Usu�rios � Administrador
            ){
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
    
    public function getPathFile($field='foto'){
        return $this->Behaviors->Upload->settings[$this->alias][$field]['path'];
    }
    
    public function getNewName($filename = ''){
        return uniqid();
    }
    
    
    public function getAniversariantesSemana() {
        $this->recursive = 0;
        
        $arr_conditions[] = array('WEEKOFYEAR( CONCAT( YEAR(NOW()),"-",MONTH(Usuario.data_nascimento),"-",DAY(Usuario.data_nascimento) ) ) = WEEKOFYEAR( NOW() )');
        $arr_conditions[] = array('Usuario.status = 2');
        
        $lista = $this->find('all', array(
                                    'conditions'=>array( $arr_conditions ),
                                    'order' => array('nascimento_order' => 'ASC'),
                                    'fields' => array('Usuario.nome', 'Usuario.email', 'Usuario.ramal', 'Usuario.data_nascimento', 'DATE_FORMAT(Usuario.data_nascimento, "%m%d") as nascimento_order'),
        ));
        return $lista;
    }

}
