<div class='table-responsive'>
    <table class='table table-bordered description-table'>
        @if(isset($xml) && $xml)
            @php
                $i=1;
            @endphp
            @foreach($xml->children() as $element)
                @php
                    $i++;
                @endphp
                <tr class="{{ !($i % 2) ? 'odd' : 'even' }}">
                    <td> {{ $element->Attribut }}</td>
                    <td> {{ $element->Valeur }}</td>
                </tr>
            @endforeach
        @else
            <tr class="odd">
                <td>Datasheet Not Set</td>
            </tr>
        @endif
    </table>
</div>
