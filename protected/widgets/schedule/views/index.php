
<div class="schedule">
	<div class="places">
		<? foreach ( $schedule as $place => $scheduleInfo ): ?>
			<a class="change-place" href="#" data-info="<?= CHtml::encode(CJSON::encode($scheduleInfo)) ?>"><?= $place ?></a>
		<? endforeach ?>
	</div>
	<div class="cabinets"></div>

	<div class="schedule-area">
		<div class="schedule-map">
            <div class="row head">
                <span class="cell h">Время</span>
                <span class="cell">Пн</span>
                <span class="cell">Вт</span>
                <span class="cell">Ср</span>
                <span class="cell">Чт</span>
                <span class="cell">Пт</span>
                <span class="cell">Сб</span>
                <span class="cell">Вс</span>
            </div>
			<? for ( $t = strtotime('7:00'); $t <= strtotime('21:00'); $t += (60 * 30) ): ?>
				<div class="row">
                    <span class="cell h"><?= date('H:i', $t) ?></span>
                    <? for ( $i = 0; $i < 7; $i++ ): ?>
                        <span class="cell"></span>
                    <? endfor ?>
				</div>
			<? endfor ?>
		</div>

		<div class="events-container"></div>
	</div>

</div>
