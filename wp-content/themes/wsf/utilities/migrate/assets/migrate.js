const envs = [ 'Select Environment...', 'Production', 'Staging', 'Development' ];
const from = document.getElementById('transfer_from');
const to   = document.getElementById('transfer_to');
const show = document.getElementById('cli_wrapper');
const intro = 'wp search-replace --network \'';
const svg = 
'<span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000" class="w-6 h-6">' +
'<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />' +
'</svg></span>'; 

var developmentUrls = [
    'applied-bio.poolbreezedev.wpengine.com',
    'baquacil.poolbreezedev.wpengine.com',
    'parent.poolbreezedev.wpengine.com',
    'sirona.poolbreezedev.wpengine.com',
    'poolife.poolbreezedev.wpengine.com',
    'leisure-time.poolbreezedev.wpengine.com',
    'glb.poolbreezedev.wpengine.com',
    'poolbreezedev.wpengine.com'
];

var productionUrls = [
    'appliedbio.net',
    'baquacil.com',
    'parent.poolbreeze.com',
    'sironaspacare.com',
    'poolife.com',
    'leisuretimespa.com',
    'glbpool.com',
    'poolbreeze.com'
];

var stagingUrls = [
    'applied-bio.poolbreezestg.wpengine.com',
    'baquacil.poolbreezestg.wpengine.com',
    'parent.poolbreezestg.wpengine.com',
    'sirona.poolbreezestg.wpengine.com',
    'poolife.poolbreezestg.wpengine.com',
    'leisure-time.poolbreezestg.wpengine.com',
    'glb.poolbreezestg.wpengine.com',
    'poolbreezestg.wpengine.com'
];

//
// Add options to the "TO" select list 
function popSelect(arr) {
    arr.forEach( function(a, i) {
        var opt = document.createElement("option");
        opt.textContent = a;
        if ( i != 0 ) {
            opt.value = a.toLowerCase();
        }
        to.appendChild(opt);
    });
}

//
// Pair arrays to environment being migrated
function matchup(from_loc, to_loc) {
    switch(from_loc) {
        case "production": {
            var a = productionUrls;
            break;
        }
        case "staging": {
            var a = stagingUrls;
            break;
        }
        case "development": {
            var a = developmentUrls;
            break;
        }
    }
    switch(to_loc) {
        case "production": {
            var b = productionUrls;
            break;
        }
        case "staging": {
            var b = stagingUrls;
            break;
        }
        case "development": {
            var b = developmentUrls;
            break;
        }
    }
    return [a, b];
}

//
// Gracefully copy the content...
function gracefulCopyToClipboard(text) {

    var textArea = document.createElement("textarea");
    var text = document.getElementById(`${text}`);
    textArea.value = text.value;

    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        var successful = document.execCommand('copy');
        var list = document.querySelectorAll('.cli-wrapper');
        if ( list != null ) {
            list.forEach( el => el.setAttribute('class','cli-wrapper cli-copied') );
        }
        text.setAttribute('class','copy copied current');
        //var msg = successful ? 'successful' : 'unsuccessful';
        //console.log('Graceful: Copying text command was ' + msg);
    } catch (err) {
        console.error('Graceful: Error while attempting Copy: ', err);
    }

    document.body.removeChild(textArea);
}

//
// Attempt the "new and improved way..."
function copyToClipboard(text) {

    if (!navigator.clipboard) {
        gracefulCopyToClipboard(text);
        return;
    }

    navigator.clipboard.writeText(text.innerText).then(function() {
        // console.log('CopyTo: Copying to clipboard was successful!');
    }, function(err) {
        console.error('CopyTo: Could not copy text: ', err);
    });

}

//
// init
document.addEventListener("DOMContentLoaded",function() {
    //
    // populate "to" drop down.
    popSelect(envs); 

    //
    // watch for changes on From env. select list
    from.onchange = (e) => {
        if ( from.selectedIndex != 0 ) {
            to.options.length = 0;
            popSelect(envs);
            to.remove(from.selectedIndex);
        } else {
            to.options.length = 0;
            popSelect(envs);        
        }
    }

    //
    // Watch for changes on To env. select list
    to.onchange = (e) => {
        if ( from.selectedIndex != 0 && to.selectedIndex !=0 ) {
            var matches = matchup(from.value, to.value);
            //
            // clear currently selected shown if any...
            var instructs = document.querySelectorAll('.copy');
            if ( instructs != null ) {
                instructs.forEach( function(i) {
                    i.remove();
                });
            }
            //
            // Process the lists and concatenate the URLs into the WP CLI statement
            matches.forEach(function(match, i){
                if( i == 0 ) {
                    var p = document.createElement("textarea");
                    p.id = 'wp-cli-commands';
                    p.setAttribute('class', 'copy');
                    p.setAttribute('onclick', 'copyToClipboard(\'wp-cli-commands\')');
                    show.appendChild(p);
                    match.forEach( function(m, r) {

                        // p.setAttribute('class', 'copy');
                        // p.setAttribute('onclick', 'copyToClipboard(\'instruction-'+r+'\')');
                        var newurl = matches[1][r];
                        var instruct = intro + m + '\' \'' + newurl + '\' --url=' + m + '\n';
                        p.value += instruct;
                        // p.innerHTML = instruct;
                        // show.appendChild(p);
                    });
                }
            });

        }
    }

});