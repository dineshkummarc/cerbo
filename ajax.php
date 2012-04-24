<?php
	
	require_once 'autoload.php';
	
	$bdd = new BDD();
	$session = new Session();
	
	if ( isset( $_GET['action'] ) )
	switch ( $_GET['action'] )
	{
	
		// preview ticket
		case '5ebeb6065f64f2346dbb00ab789cf001':
			
			$ticket = new Ticket( $_GET['target'] );
			echo $ticket->toJSON();
			
			break;
			
		// preview type ticket
		case '23d0ed5c51e92eec776e9315235edc0c':
			
			$type = new TypeTicket( $_GET['target'] );
			echo $type->toJSON();
			
			break;
		
	}

?>