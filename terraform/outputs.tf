output "public_ip" {
  value = aws_instance.wordpress.public_ip
}

output "public_dns" {
  value = aws_instance.wordpress.public_dns
}

output "website_url" {
  value = "http://${aws_instance.wordpress.public_ip}"
}

output "jenkins_url" {
  value = "http://${aws_instance.wordpress.public_ip}:8081"
}

output "ssh_command" {
  value = "ssh -i wordpress-akc.pem ubuntu@${aws_instance.wordpress.public_ip}"
}
