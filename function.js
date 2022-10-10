const AWS = require('aws-sdk');
const SES = new AWS.SES({region: 'us-east-1'});

exports.handler = (event, context, callback) => {
    console.log(JSON.stringify(event));
    event.Records.forEach(record =>{
        let {body} = record;

        body = JSON.parse(body);
        console.log(body);

        const params = {
            'Destination': {
                'ToAddresses': [body.sendTo]
            },
            'Template': body.Template,
            'Source': body.Source,
            'TemplateData': body.TemplateData
        };

        console.log(params);

        SES.sendTemplatedEmail(params, function (err, res) { 
            console.log('Entrou no SES');
            callback(null,{err:err, data:res});
            if(err){
                console.log(err);
                context.fail(err);
            }else{
                console.log(res);
                context.succeed(err);
            }
        });   
    });
}
