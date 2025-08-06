<div class="container p-5 theborder_table">
	<p>Your refer code is <?=$profile_data['refer_code']?><br/>
		Your refer link would be <?=base_url('/signup?refer=')?><?=$profile_data['refer_code']?></p>
		<a href="<?=base_url('index.php/main/refer?do=sign')?>">SIGNUPS</a> -
		<a href="<?=base_url('index.php/main/refer?do=plan')?>">PLAN SELLS</a>
	<table class="col-12">
		<tr style="font-weight: bold;">
			<td>
				Id
			</td><td>
				Name
			</td><td>
				Email
			</td><td>
				Phone
			</td><td>
				Date
			</td><td>
				Plan
			</td><td>
				Total Amount Paid
			</td>
		</tr>

		<?php foreach($my_refers as $refers){ ?>
			<tr>
			<td>
				<?=$refers['mid']?>
			</td><td>
				<?=$refers['name']?>
			</td><td>
				<?=$refers['email']?>
			</td><td>
				<?=$refers['contact']?>
			</td><td>
				<?=date_format_1($refers['date'],1)?>
			</td><td>
				<?=$refers['user_plan']?>
			</td><td>
				<?=$refers['amount_paid']?>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>