<?php

namespace customerCareApp;

class Model_Config extends \Model_Table { 
	var $table= "customerCareApp_config";
	function init(){
		parent::init();

		$this->hasOne('customerCareApp/Company','customerCareApp_company_id');

		$this->addField('name');   


		$this->addHook('beforeDelete',$this);
		$this->addHook('beforeSave',$this);

		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function beforeDelete(){

	}

	function beforeSave(){
		
	}
}