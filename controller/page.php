<?php

class page extends App 
{
	public function indexAction()
	{
		echo $this->loadView ('home');
	}

	public function aboutAction()
	{
		echo $this->loadView('about');
	}

	public function tesAction()
	{
		$data = array('nama' => 'Wisnu');

		echo $this->loadView('home', $data);
	}

	public function artikelAction()
	{
		$this->loadModel ('ArtikelModel');
	
		$artikel = $this->artikelmodel->all();

		echo $this->loadView('home', array(
			'data_artikel' => $artikel
		));
	}
}
