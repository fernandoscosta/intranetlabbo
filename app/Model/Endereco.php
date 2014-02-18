<?php
App::uses('AppModel', 'Model');
/**
 * Endereco Model
 *
 * @property TipoEndereco $TipoEndereco
 * @property Usuario $Usuario
 */
class Endereco extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'titulo';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'tipo_endereco_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'N�o pode ser vazio.',
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser num�rico.',
			),
		),
		'usuario_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'N�o pode ser vazio.',
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Deve ser num�rico.',
			),
		),
		'titulo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'N�o pode ser vazio.',
			),
		),
        'cep' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'N�o pode ser vazio.',
			),
            'valid' => array(
                'rule' => array('postal', null, 'br'),
                'message' => 'Necess�rio Cep v�lido.',
                'allowEmpty' => true,
            )
        ),
		'endereco' => array(
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
		'TipoEndereco' => array(
			'className' => 'TipoEndereco',
			'foreignKey' => 'tipo_endereco_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
