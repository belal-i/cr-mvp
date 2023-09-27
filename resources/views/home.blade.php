@extends ('layouts/site')
@section ('content')
<div class="row">
    <div class="col" id="homepage-cover-image">
        <div id="quickfilter-container" class="container">
            <form class="row form-inline" id="quickfilter-form">
                <div class="col"></div>

                <div class="col quickfilter-form-elem quickfilter-form-label">Zimmer</div>
                <div class="col quickfilter-form-elem">
                    <select class="form-control no-radius" id="quickfilter-nr-rooms">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>

                <div class="col quickfilter-form-elem quickfilter-form-label">Miete (max.)</div>
                <div class="col quickfilter-form-elem">
                    <input class="form-control no-radius" type="text" id="quickfilter-rent" placeholder="EUR">
                </div>

                <div class="col-1 quickfilter-form-elem quickfilter-form-label">ab</div>
                <div class="col quickfilter-form-elem">
                    <select class="form-control no-radius" id="quickfilter-start-month">
                        <option>sofort</option>
                        <option>Oktober</option>
                        <option>November</option>
                        <option>Dezember</option>
                        <option>später</option>
                    </select>
                </div>

                <div id="quickfilter-submit-button" class="col-3 quickfilter-form-elem quickfilter-form-label" onclick="alert('TODO: Implement REST endpoint in backend for the model Offer, so we can filter by the values in this form.');">
                    100 Ergebnisse anzeigen
                </div>

                <div class="col"></div>
            </form>


        </div>
    </div>
</div>
@endsection
