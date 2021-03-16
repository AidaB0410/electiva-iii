@if (session('type') && session('title') && session('msg'))
<script type="text/javascript">
	Lobibox.notify('{{ session('type') }}', {
		@if (strpos(url()->current(), "/maesma")===false)
		iconSource: 'icon',
		@endif
		title: '{{ session('title') }}',
		sound: true,
		msg: '{{ session('msg') }}'
	});
</script>
@endif