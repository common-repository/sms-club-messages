<div class="form">
    <form id="form_message">
        <h3 class="name-form">Отправка <?php echo esc_html($title); ?></h3>

        <?php if (!$originators) { ?>
            <p>Не удалось получить список альфаимён. Проверьте токен в настройках плагина, затем убедитесь,
                что имеете активное альфаимя в <a href="<?php echo esc_url(SMSCLUB_USER_PROFILE_URL); ?>" target="_blank">личном кабинете на сайте Sms Club</a>
            </p>
        <?php } else { ?>
        <div class="form-group">
            <div id="left-side">
                <div class="select-alpha-name">
                    <label for="alpha-name">Альфа имя:</label>
                    <select name="alpha-name" id="alpha-name">
                       <?php foreach($originators as $originator): ?>
                            <option value="<?php echo esc_attr($originator->getName()); ?>"><?php echo esc_html($originator->getName()); ?></option>
                       <?php endforeach; ?>
                    </select>
                    <p class="error alphaName-error" hidden>*У Вас нету Альфа имени</p>
                </div>
                <div class="text-sms">
                    <label for="alpha-sms">Текст сообщения:</label>
                    <div>
                        <textarea name="textarea-sms" class="textarea-message" id="textarea-message" placeholder="текст сообщения"></textarea>
                        <p class="error textarea-error" hidden>*Поле Текст сообщения обязательно к заполнению</p>
                        <p class="translit" hidden> Транслитерация сообщения</p>
                        <p> Количество символов смс - <span class="valueLength">0</span></p>
                    </div>
                </div>
            </div>
            <div id="right-side">
                <div class="phone-number">
                    <label for="phone">Телефон: </label>
                    <div class="phone-number">
                        <input class="phone phone-receiver" name="phone" type="text" placeholder="380123456789, 380123456789...">
                        <p class="error phone-error" hidden>*Поле Телефон обязательно к заполнению</p>
                    </div>
                </div>
                <p class="send"><input type="button" class="send-message" value="Отправить"></p>
                <input id="type-message" value="<?php echo esc_attr($typeMessage); ?>" hidden>
            </div>
        </div>
        <?php } ?>
    </form>
</div>