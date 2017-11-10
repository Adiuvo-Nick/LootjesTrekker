<?php
class LootjesTrekken {
    private $errors = [];
	public function run() {

			//Haalt de namen op en zet ze in een array
			$names = array();
			$list = array();

			for($c=0;$c<$_POST['count'];$c++){
				//Check of value niet empty is
				if(!empty($_POST['user_name_'.$c]) ){
					$names[] = $_POST['user_name_'.$c];
					$list[] = $_POST['user_name_'.$c];
				}
			}

			//Er moeten minimaal 2 namen geregistreerd worden
			if(count($names)<2) {
				$this->addError("Er moeten minimaal 2 namen geregistreerd worden");
			}
			//Er mogen maximaal 10 namen geregistreerd worden
			if(count($names)>10){
				$this->addError("Er mogen maximaal 10 namen geregistreerd worden");
			}
			else{
				$this->randomNamePicker($names,$list);
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
     */
	private function randomNamePicker($names ,$list) {
		foreach ($names as &$name) {
			$list = array_values($list);
			$count = count($list)-1;
			$random = rand(0, $count);
			$match = $list[$random];


			while ($name == $match) {
				$random = rand(0, $count);
				$match = $list[$random];
			}


			if ( $name != $match && $match != "" ) {
				echo "$name Heeft $match <br/>";
				unset($list[$random]);
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