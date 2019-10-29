@csrf
<label for="title">@lang('Project name')</label>
<input
    type="text"
    placeholder="@lang('Enter the name of your project')",
    name="title"
    value="{{ old('title', $project->title) }}"
    class=""
>
<button type="submit">
    @lang($btnName)
</button>
