<?php
class VideoDetailsFormProvider {
          private $con;
          public function __construct($con) {
            $this->con = $con;
          }
          public function createUploadForm(){
                    $fileInput = $this->createFileInput();
                    $titleInput = $this->createTitleInput();
                    $descriptionInput = $this->createDescriptionInput();
                    $privacyInput = $this->createPrivacyInput();
                    $categoriesInput = $this->createCategoriesInput();
                    $submitButton = $this->createUploadButton();
                    return "<form class='w-100' action='proccessing.php' method='POST' enctype='multipart/form-data'>
                              $fileInput
                              $titleInput
                              $descriptionInput
                              $privacyInput
                              $categoriesInput
                              $submitButton
                            </form>";
          }


          private function createFileInput(){
          return "<div class='form-group'>
                    <label for='exampleFormControlFile1'>Your File </label> <br>
                    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='fileInput' required>
          </div>";
          }

          private function createTitleInput()
          {
                    return "<div class='form-group mt-2'>
                    <input type='text' class='form-control' placeholder='Title' name='titleInput' required>
                  </div>";
          }
          private function createDescriptionInput()
          {
                    return "<div class='form-group mt-2'>
                               <textarea class='form-control' name='descriptionInput' placeholder='Description' id='exampleFormControlTextarea1' rows='3'></textarea>
                            </div>";
          }
          private function createPrivacyInput()
          {
                    return "<div class='form-group mt-2'>
                              <select class='form-select' aria-label='Default select example' name='privacyInput'>
                                        <option value='0'>Private</option>
                                        <option value='1'>Public</option>
                              </select>'
                           </div>";
              
          }


          private function createCategoriesInput() {
            $query = $this->con->prepare("SELECT * FROM categories");
            $query->execute();

            $html = "<div class='form-group mt-2'>
                              <select class='form-select' aria-label='Default select example' name='categoryInput'>";
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $name = $row["name"];
                $id = $row["id"];
                $html .= "<option value='$id'>$name</option>";
            }



          $html .= "</select></div>";
          return $html;
        }

          private function createUploadButton() {
              return "<button type='submit' name='uploadButton' class='btn btn-primary mt-2'>Upload</button>";
          }

}
?>