podTemplate(
    label: 'mypod',
    inheritFrom: 'default',
    containers: [
        containerTemplate(
            name: 'composer',
            image: 'composer:1.8',
            ttyEnabled: true,
            command: 'cat',
            resourceRequestMemory: '300Mi'
        ),
        containerTemplate(
            name: 'docker',
            image: 'docker:18.02',
            ttyEnabled: true,
            command: 'cat'
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
                sh 'ls -la'
                sh 'composer install --no-interaction --prefer-dist --optimize-autoloader'
            }
        }
        def repository
        stage ('Docker') {
            container ('docker') {
                repository = "gcr.io/istioplay/php-api"
                withCredentials([file(credentialsId: 'istioplayfile', variable: 'GC_KEY')]) {
                    echo "${GC_KEY}"
                    sh "docker login -u _json_key -p "$(cat ${GC_KEY})" https://gcr.io"
                    sh "docker build -t ${repository}:${commitId} ."
                    sh "docker push ${repository}:${commitId}"
                }
            }
        }
        stage ('Deploy') {
            container ('helm') {
                sh "/helm init --client-only --skip-refresh"
                sh "/helm upgrade --install --wait --set image.repository=${repository},image.tag=${commitId} hello hello"
            }
        }
    }
}
