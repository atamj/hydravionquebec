@extends('layouts.app')

@section('content')
	<div id="current-post">
	<div class=" h-screen py-[10vw] min-h-[500px]   pb-12 relative flex flex-col justify-center">
		<img src="<?= get_default_image_placeholder() ?>" alt=""
			 class="z-[1] absolute top-0 h-full object-cover w-full right-0"
		/>
		<div aria-hidden="true" class="absolute inset-0 z-[1] bg-gradient-b-to-t "></div>
		<div class="mx-auto w-full max-w-[1536px] px-6 z-[2]">
			<div class="max-w-[600px]">
				<div class="flex gap-2 mb-4">
					<?= get_the_category_list('•') ?>
				</div>
				<h1 class="text-6xl leading-[1.1] font-semibold mb-7 "><?= __('Oops, cette page est introuvable.', 'ng') ?></h1>
				<p>
					<?= __('Désolé, l\'URL que vous avez demandée n\'existe pas sur ce site. Veuillez vérifier l\'adresse et essayez de nouveau.', 'ng') ?>
				</p>
			</div>
		</div>
	</div>
</div>
@endsection
