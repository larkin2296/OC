<form data-url="" data-method="" data-type="json">
    @for ($i = 1; $i <= 3; $i++)
        @include(getThemeTemplate('back.report.value.components.' . $tab->id . '-' . $i ))
    @endfor
</form>