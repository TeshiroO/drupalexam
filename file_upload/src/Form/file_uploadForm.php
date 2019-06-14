<?php

function file_upload($form, &$form_state) {
	
	$form['upload_item'] = array(
		'#type' => 'file',
		'#title' => 'Upload File'
	);
	
	if(isset($_SESSION['uploaded_link'])) {
		$form['uploaded_link'] = array(
			'#type' => 'markup',
			'#markup' => '<a href="' . $_SESSION['uploaded_link'] . '">' . $_SESSION['uploaded_link'] . '</a>'
		);
		
		unset($_SESSION['uploaded_link']);
	}
	
	
	
	$form['upload_submit'] = array(
		'#type' => 'submit',
		'#value' => 'Upload File',
		'#submit' => array('upload_file_submit')
	);
	
	return $form;
	
}

function upload_file_submit($form, &$form_state) {

	$validators = array(
		'file_validate_extensions' => array("pdf")
	);
	
	$location = 'public://';
	
	$uploadCheck = file_save_upload('upload_item', $validators, $location);
	
	if($uploadCheck) {
		$link = file_create_url($uploadCheck->uri);
		$_SESSION['uploaded_link'] = $link;
	}
	
	
}