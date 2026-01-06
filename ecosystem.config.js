module.exports = {
    apps: [
        {
            name: "karang-taruna-queue",
            script: "artisan",
            interpreter: "php",
            args: "queue:work --sleep=3 --tries=3 --max-time=3600",
            instances: 1,
            autorestart: true,
            watch: false,
            max_memory_restart: "512M",
            env: {
                NODE_ENV: "production",
            },
            error_file: "./storage/logs/pm2-queue-error.log",
            out_file: "./storage/logs/pm2-queue-out.log",
            log_date_format: "YYYY-MM-DD HH:mm:ss Z",
            merge_logs: true,
        },
        {
            name: "karang-taruna-scheduler",
            script: "artisan",
            interpreter: "php",
            args: "schedule:work",
            instances: 1,
            autorestart: true,
            watch: false,
            max_memory_restart: "256M",
            env: {
                NODE_ENV: "production",
            },
            error_file: "./storage/logs/pm2-scheduler-error.log",
            out_file: "./storage/logs/pm2-scheduler-out.log",
            log_date_format: "YYYY-MM-DD HH:mm:ss Z",
            merge_logs: true,
        },
    ],
};
