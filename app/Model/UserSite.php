<?php
App::uses('AppModel', 'Model');
/**
 * UserSite Model
 *
 * @property Url $Url
 * @property User $User
 */
class UserSite extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'UserSite';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'UserSiteID';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'SiteDescr';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Url' => array(
			'className' => 'URL',
			'foreignKey' => 'URLID',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'UserID',
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
	'UserSiteTag' => array(
			'className' => 'UserSiteTag',
			'foreignKey' => 'UserSiteID',
			'dependent' => true,    // true means delete tags that depend on this UserSite if we delete
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	// BEGIN LARRY'S SPIKE FOR TAGS
	// THAT IS WORKING
    public $recursive = -1;

    public $actsAs = array('Containable');

    public function getTagRecordsForUserSite($UserSiteID) {
        $userSite = $this->find('first',
            array(
                'conditions' => array(
                    'UserSite.UserSiteID' => $UserSiteID
                ),
                'contain' => array(
                    'UserSiteTag' => array()
                )
            )
        );
        return $userSite;
    }

}
