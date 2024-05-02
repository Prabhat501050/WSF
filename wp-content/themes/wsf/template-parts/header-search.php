<div class="container p-6 bg-white shadow-lg opacity-0 hidden pointer-events-none -translate-y-6 transition-expo lg:rounded-b-md relative z-40 max-h-screen overflow-y-auto" id="header-nav-search">
	<form action="/" id="header-search-form" class="mb-8">
		<div class="relative">
			<button class="text-red absolute top-1/2 -translate-y-1/2 left-6" type="submit">
				<?= file_get_contents(get_template_directory() . '/assets/icons/search.svg'); ?>
			</button>
			<input data-rlvlive="true" data-rlvparentel="#wsf-header-search-results" type="search" name="s" placeholder="Enter a search term" class="p-6 pl-16 text-2xl heading bg-gray-100 block rounded-md w-full">
		</div>
	</form>

	<div id="wsf-header-search-results"></div>

	<!-- <h5 class="mb-4">Suggested</h5>

	<ul class="space-y-2">
		<li>
			<p class="bg-gray-100 px-3 pl-7 rounded-md inline-block bg-no-repeat bg-[0.5rem_center] bg-search bg-4"><span class="text-red">Chick</span>en Salad</p>
		</li>
		<li>
			<p class="bg-gray-100 px-3 pl-7 rounded-md inline-block bg-no-repeat bg-[0.5rem_center] bg-search bg-4"><span class="text-red">Chick</span>en Salad</p>
		</li>
		<li>
			<p class="bg-gray-100 px-3 pl-7 rounded-md inline-block bg-no-repeat bg-[0.5rem_center] bg-search bg-4"><span class="text-red">Chick</span>en Salad</p>
		</li>
		<li>
			<p class="bg-gray-100 px-3 pl-7 rounded-md inline-block bg-no-repeat bg-[0.5rem_center] bg-search bg-4"><span class="text-red">Chick</span>en Salad</p>
		</li>
	</ul> -->
</div>