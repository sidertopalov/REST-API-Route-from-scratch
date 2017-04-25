<?php

interface iCrud
{
	public function get($id=null);
	public function post($id=null);
	public function delete($id);
}