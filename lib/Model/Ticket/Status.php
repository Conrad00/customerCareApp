<?php

namespace customerCareApp;

class Model_Ticket_Status extends \Model_Table { 
	var $table= "customerCareApp_ticket_status";
	function init(){
		parent::init();


		$this->addField('name');
		$this->hasMany('customerCareApp/Ticket','ticket_id');

		$this->addHook('beforeDelete',$this);
		$this->addHook('beforeSave',$this);

		$this->add('dynamic_model/Controller_AutoCreator');
	}
	function beforeDelete(){
		if($this->ref('customerCareApp/Status')->count()->getOne()>0)
			throw $this->exception('You can not delete this.It has a status...');

	}

	function beforeSave(){
		$status=$this->add('customerCareApp/Model_Status');
		$this->loaded();
		if($status->loaded()){
		$status->addCondition('id','<>',$this->id);
		}
		$status->addCondition('name',$this['name']);
		$status->tryLoadAny();
		throw $this->exception('it is exist');
		
		
	}
}