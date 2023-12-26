<section class = "questions">
    <div class = "container">
        <hr>
        <h1>ОСТАЛИСЬ ВОПРОСЫ?</h1>
        <p>Оставьте ваш телефон.<br> Мы свяжемся с Вами.</p>
        <div class = "questions-flex">
            <form action = "" method = "post">
              <div class="form-group">
                  <label for="formGroupExampleInput">Имя *</label>
                  <input type="text" name = "question-name" class="form-control" id="formGroupExampleInput" placeholder="Иван" required>
              </div>
              <div class="form-group">
                  <label for="formGroupExampleInput2">Телефон *</label>
                  <input class = "tel" name = "question-number" class="form-control" id="formGroupExampleInput2" placeholder="+7" required>
              </div>
              <button type="submit" name = "btn-questions" class="btn btn-success">Получить консультацию</button>
              <p><?php if(isset($_POST['btn-questions'])) send(-1, htmlspecialchars($_POST['question-name']), htmlspecialchars($_POST['question-number']), $work_mail, $server, $dbname, $user, $pass); ?></p>
            </form>
        </div>
    </div>
</section>