function base_url()
{
    if(window.location.origin == 'http://localhost') {
        return 'http://localhost/english-vocabulary/';
    } else {
        return 'TODOPRODUCTION';
    }
}
