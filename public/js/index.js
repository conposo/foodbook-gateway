
if('serviceWorker' in navigator) {
    navigator.serviceWorker.register('sw.js').then(function(result){
        console.log('SW Registered', 'Scope: '+result.scope)

        if('Notification' in window) {
            console.log('Notificatons Supported')
            Notification.requestPermission(function(status){
                console.log('Notification Status: '+status)
            })
            notify('something')
        }
    }, function(error){
        console.log(error)
    })
} else {
    console.log('Service Workers Not Supported');
}


function notify(title){
    if(Notification.permission === 'granted'){
        navigator.serviceWorker.ready.then(function(reg){
            reg.showNotification(title)
        })
    }
}