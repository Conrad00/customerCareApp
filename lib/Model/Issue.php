<?php

namespace customerCareApp;

class Model_Issue extends \Model_Table {
	var $table= "customerCareApp_issue";
	function init(){
		parent::init();

		$this->hasOne('customerCareApp/Company','customerCareApp_company_id');

		$this->addField('name');

		$this->addHook('beforeSave',$this);

		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function beforeSave(){
		$issue=$this->add('customerCareApp/Model_Issue');
		$this->loaded();
		if($issue->loaded()){
		$issue->addCondition('id','<>',$this->id);
		}
		$issue->addCondition('name',$this['name']);
		$issue->tryLoadAny();
		throw $this->exception('it is exist');
		
		
	}
}