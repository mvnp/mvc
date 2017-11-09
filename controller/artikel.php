<?php

class artikel extends App
{
	public function __construct()
	{
		$this->loadModel('ArtikelModel');
	}

	public function indexAction()
	{
		$artikel = $this->artikelmodel->all();

		$isi_halaman = $this->loadView('artikel', array('data_artikel' => $artikel));

		echo $this->loadView('layout', array('content' => $isi_halaman));
	}

	public function detailAction()
	{
		$id = $this->uri_segment(2);
		$artikel = $this->artikelmodel->one($id);

		if ($artikel==false){
			$this->loadNotFound();
		} else {
			$isi_halaman = $this->loadView('detail_artikel', array('row' => $artikel));
			echo $this->loadView('layout', array('content' => $isi_halaman));
		}
	}
}