<div class="wrap">

    <?php if ( empty($stat_informs) ) : ?>
        <div class="header-block not-statistic-data">
            <div class="statistic-data">
                <p>Ещё нет данных для просмотра</p>
            </div>
        </div>
    <?php endif; ?>

    <?php if ( !empty($stat_informs) ) : ?>
    <div class="statistic-block">
        <div class="filter-block">
            <div class="select-type-message">
                <label for="select-type-mess" class="label-type-message">Тип:</label>
                <select name="select-type-mess" class="select-type-mess">
                    <option data-type="all" <?php echo esc_html($selecAll); ?> value="<?php echo esc_attr($stat_informs_url); ?>">Все</option>
                    <option data-type="viber" <?php echo esc_html($selecViber); ?> value="<?php echo esc_attr($stat_informs_url); ?>">Viber</option>
                    <option data-type="sms" <?php echo esc_html($selecSms); ?> value="<?php echo esc_attr($stat_informs_url); ?>">СМС</option>
                </select>
            </div>
            <!-- <div class="select-number-message">
                <label for="select-number-mess" class="label-number-message">Количество:</label>
                <select name="select-number-mess" class="select-number-mess">
                    <option value="50">50</option>
                    <option value="40">40</option>
                    <option value="30">30</option>
                    <option value="20">20</option>
                    <option value="10">10</option>
                </select>
            </div> -->
        </div>
        <table class="wp-list-table widefat fixed striped table-view-list posts table-statistic">
            <thead>
                <tr>
                    <th class="manage-column">Альфа имя:</th>
                    <th class="manage-column">Номер получателя</th>
                    <th class="manage-column">Дата отправки</th>
                    <th class="manage-column">Текст</th>
                    <th class="manage-column">Статус</th>
                    <th class="manage-column">Тип</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($stat_informs as $stat_inform) : ?>
                <tr>
                    <td><?php echo esc_html($stat_inform->sender_name) ?></td>
                    <td><?php echo esc_html($stat_inform->message_number) ?></td>
                    <td><?php echo esc_html($stat_inform->creation_date) ?></td>
                    <td><?php echo esc_html($stat_inform->message_text) ?></td>
                    <td><?php echo esc_html($stat_inform->status) ?></td>
                    <td><?php echo esc_html($stat_inform->message_type) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p class="full-statistic">Для просмотра полной статистики перейдите в <a href="<?php echo esc_url(SMSCLUB_SMS_REPORT_URL); ?>" target="_blank">кабинет Sms Club</a></p>
    </div>
    <?php endif; ?>
</div>