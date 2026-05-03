provider "aws" {
  region = "eu-central-1"
}

# 1. VPC & Networking
resource "aws_vpc" "masons_vpc" {
  cidr_block = "10.0.0.0/16"
  tags = { Name = "MasonsVPC" }
}

# 2. RDS (Database)
resource "aws_db_instance" "masons_db" {
  allocated_storage    = 20
  engine               = "mysql"
  engine_version       = "8.0"
  instance_class       = "db.t3.micro" # Cost optimization
  name                 = "masons_prod"
  username             = "admin"
  password             = var.db_password
  multi_az             = true
  skip_final_snapshot  = true
}

# 3. S3 (Storage)
resource "aws_s3_bucket" "masons_assets" {
  bucket = "masons-aupair-assets-prod"
}

# 4. ECS Cluster (Compute)
resource "aws_ecs_cluster" "masons_cluster" {
  name = "masons-production-cluster"
}

# 5. Security Groups
resource "aws_security_group" "alb_sg" {
  name = "alb-sg"
  vpc_id = aws_vpc.masons_vpc.id

  ingress {
    from_port   = 80
    to_port     = 80
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  ingress {
    from_port   = 443
    to_port     = 443
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
}
