<?php
class VideoDeatailsFormProvider
{
          public function createUploadForm()
          {
                    $fileInput = $this->createFileInput();
                    $titleInput = $this->createTitleInput();
                    $descriptionInput = $this->createDescriptionInput();
                    $privacyInput = $this->createPrivacyInput();
                    return "<form class='w-100' action='prossecing.php' method='POST'>
                              $fileInput
                              $titleInput
                              $descriptionInput
                              $privacyInput
                            </form>";
          }


          private function createFileInput()
          {
                    return "
          <div class='form-group'>
                    <label for='exampleFormControlFile1'>Your File </label>
                    <input type='file' class='form-control-file' id='exampleFormControlFile1' required>
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
                               <textarea class='form-control' placeholder='Description' id='exampleFormControlTextarea1' rows='3'></textarea>
                            </div>";
          }
          private function createPrivacyInput()
          {
                    return "<div class='form-group mt-2'>
                              <select class='form-select' aria-label='Default select example'>
                                        <option value='0'>Private</option>
                                        <option value='1'>Public</option>
                              </select>'
                           </div>";
          }
}
