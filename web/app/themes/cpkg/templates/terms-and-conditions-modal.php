<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Regulamin udzielania porad prawnych <i class="fa fa-paragraph"></i></h4>
      </div>
      <div class="modal-body">
          <?php
            $termsPage = get_page_by_title('Regulamin porad prawnych');
            echo $termsPage->post_content;
          ?>
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Nie akceptuję</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="#accept-terms" data-target="#legalQuestionModal" data-toggle="modal">Akceptuję</button>
        </div>
    </div>
  </div>
</div>