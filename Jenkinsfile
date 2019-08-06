podTemplate(
    label: 'mypod',
    inheritFrom: 'default',
    containers: [
        containerTemplate(
            name: 'composer',
            image: 'composer:1.8',
            ttyEnabled: true,
            command: 'cat',
            resourceRequestMemory: '500Mi'
        ),
        containerTemplate(
            name: 'docker',
            image: 'docker:18.02',
            ttyEnabled: true,
            command: 'cat',
            resourceRequestMemory: '1500Mi'
        ),
        containerTemplate(
            name: 'helm',
            image: 'ibmcom/k8s-helm:v2.6.0',
            ttyEnabled: true,
            command: 'cat'
        )
    ],
    volumes: [
        hostPathVolume(
            hostPath: '/var/run/docker.sock',
            mountPath: '/var/run/docker.sock'
        )
    ]
) {
    node('mypod') {
        def commitId
        stage ('Extract') {
            checkout scm
            commitId = sh(script: 'git rev-parse --short HEAD', returnStdout: true).trim()
        }
        stage ('Install') {
            container ('composer') {
                sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'
                sh 'ls -la'
            }
        }
        def repository
        stage ('Docker') {
            container ('docker') {
                repository = "gcr.io/istioplay/php-api"
                sh 'ls -la'
                withCredentials([file(credentialsId: 'istioplayfile', variable: 'GC_KEY')]) {
                    echo "${GC_KEY}"
                    sh "cat ${GC_KEY} | docker login -u _json_key --password-stdin https://gcr.io"
                }
                sh "docker build -t ${repository}:${commitId} ."
                sh "docker push ${repository}:${commitId}"
            }
        }
        stage ('Deploy') {
            container ('helm') {
                sh "/helm init --client-only --skip-refresh"
                sh "/helm upgrade --install --wait --set image.tag=${commitId} php-api mychart"
            }
        }
    }
}
