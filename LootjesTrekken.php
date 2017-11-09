<?php
class LootjesTrekken {
	private $users;
    private $errors = [];

	public function run() {

			//Haalt de namen op en zet ze in een array
			$names = array();

			for($c=0;$c<$_POST['count'];$c++){
				//Check of value niet empty is
				if(!empty($_POST['user_name_'.$c]) ){
					$names[] = $_POST['user_name_'.$c];
				}
			}

			//Er moeten minimaal 2 namen geregistreerd worden
			if(count($names)<2) {
				$this->addError("Er moeten minimaal 2 namen geregistreerd worden");
			}
			//Er mogen maximaal 30 namen geregistreerd worden
			if(count($names)>3){
				$this->addError("Er mogen maximaal 30 namen geregistreerd worden");
			}

			if(!empty($names)){
				$this->randomNamePicker($names);
			}

		$this->render();
	}


	private function render() {
    
        if (count($this->errors) > 0) {
            echo '<p style="color: red; font-weight: bold;">';
            echo 'Er ging iets fout';
            echo '  <ul>';

            foreach ($this->errors as $error) {
                echo '   ' . sprintf('<li>%s</li>', $error);
            }

            echo '  </ul>';
            echo '</p>';
            echo '<br />';
        }

	}

	/**
     * Hier worden de namen gematched 
     * @param $error
     */
	private function randomNamePicker($names) {
		foreach ($names as &$name) {

			$count = count($names)-1;
			$random = rand(0, $count);
			$match = $names[$random];

			while ($name == $match) {
				$random = rand(0, $count);
				$match = $names[$random];
			}

			if ( $name != $match && $match != "" ) {
				echo "$name $match <br/>";
			}
		}
	}


    /**
     * Voeg de foutmeldingen toe aan de array errors
     * @param $error
     */
    private function addError($error)
    {
        array_push($this->errors, $error);
    }


}