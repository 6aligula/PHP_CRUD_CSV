<?php

class Cartera
{
	public $clientes = [];

	public function delete($id) {
		foreach ($this->clientes as $key => $cliente) {
			if ($cliente->getId() == $id) {
				unset($this->clientes[$key]);
				break;
			}
		}
		$this->persist();
	}
	
	public function persist() {
		$file = fopen("data.csv", "w");
		// Opcionalmente, puedes escribir los encabezados aquí
		// fputcsv($file, ["ID", "Company", "Investment", "Date", "Active"]);
	
		foreach ($this->clientes as $cliente) {
			fputcsv($file, [$cliente->getId(), $cliente->getCompany(), $cliente->getInvestment(), $cliente->getDate(), $cliente->getActive()]);
		}
		fclose($file);
	}

	public function getClient($id){
		foreach ($this->clientes as $cliente) {
			if ($cliente->getId() == $id) {
				return $cliente;
			}
		}
		return null; // Retornar null si el cliente no se encuentra
	}
	

	public function loadData($fichero)
	{
		$gestor = fopen($fichero, "r");
		$headers = fgetcsv($gestor); // Si tu CSV tiene una cabecera, esta línea la lee y descarta.
	
		while (($element = fgetcsv($gestor)) !== false) {
			array_push(
				$this->clientes, // Cambia esto de $this->clients a $this->clientes
				new Empresa(...$element) // Spread Operator
			);
		}
	
		fclose($gestor);
	}
	


	public function drawList()
	{
		$html = '';
		foreach ($this->clientes as $cliente) {
			$html .= '<tr';
			if ($cliente->isVIP()) {
				$html .= ' class="vip"';
			}
			$html .= '>';
			$html .= '<td>' . $cliente->id . '</td>';
			$html .= '<td>' . $cliente->company . '</td>';
			$html .= '<td>' . number_format($cliente->investment, 2, ',', '.') . ' €</td>';
			$html .= '<td>' . date('Y-m-d', strtotime($cliente->date)) . '</td>';
			$html .= '<td><img src="' . $cliente->getActiveImage() . '" alt="' . ($cliente->active == 'True' ? 'Active' : 'Inactive') . '"></td>';
			// Añadir la columna de acciones
			$html .= '<td>';
			$html .= '<a href="Delete.php?id=' . $cliente->getId() . '"><img src="del_icon.png" alt="Eliminar" width="30" height="30"></a>';
			$html .= '<a href="edit.php?id=' . $cliente->getId() . '"><img src="edit_icon.png" alt="Editar" width="30" height="30"></a>';
			$html .= '</td>';

			$html .= '</tr>';
		}
		return $html;
	}
}
