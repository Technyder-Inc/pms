using Microsoft.EntityFrameworkCore;
using PMS_APIs.Models;

namespace PMS_APIs.Data
{
    /// <summary>
    /// Database context for the Property Management System
    /// Configures entity relationships and database connection
    /// </summary>
    public class PmsDbContext : DbContext
    {
        public PmsDbContext(DbContextOptions<PmsDbContext> options) : base(options)
        {
        }

        // DbSets for all entities
        public DbSet<Customer> Customers { get; set; }
        public DbSet<Property> Properties { get; set; }
        public DbSet<Payment> Payments { get; set; }
        public DbSet<Registration> Registrations { get; set; }
        public DbSet<PaymentPlan> PaymentPlans { get; set; }
        public DbSet<Allotment> Allotments { get; set; }
        public DbSet<CustomerLog> CustomerLogs { get; set; }
        public DbSet<Penalty> Penalties { get; set; }
        public DbSet<Waiver> Waivers { get; set; }
        public DbSet<Refund> Refunds { get; set; }
        public DbSet<Transfer> Transfers { get; set; }
        public DbSet<Ndc> Ndcs { get; set; }
        public DbSet<Possession> Possessions { get; set; }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            base.OnModelCreating(modelBuilder);

            // Configure Customer relationships
            modelBuilder.Entity<Customer>()
                .HasOne(c => c.Registration)
                .WithMany(r => r.Customers)
                .HasForeignKey(c => c.RegId)
                .OnDelete(DeleteBehavior.SetNull);

            modelBuilder.Entity<Customer>()
                .HasOne(c => c.PaymentPlan)
                .WithMany(p => p.Customers)
                .HasForeignKey(c => c.PlanId)
                .OnDelete(DeleteBehavior.SetNull);

            // Configure Transfer relationships with different foreign keys
            modelBuilder.Entity<Transfer>()
                .HasOne(t => t.FromCustomer)
                .WithMany(c => c.TransfersFrom)
                .HasForeignKey(t => t.FromCustomerId)
                .OnDelete(DeleteBehavior.Restrict);

            modelBuilder.Entity<Transfer>()
                .HasOne(t => t.ToCustomer)
                .WithMany(c => c.TransfersTo)
                .HasForeignKey(t => t.ToCustomerId)
                .OnDelete(DeleteBehavior.Restrict);

            // Configure indexes for better performance
            modelBuilder.Entity<Customer>()
                .HasIndex(c => c.Cnic)
                .IsUnique(false);

            modelBuilder.Entity<Customer>()
                .HasIndex(c => c.Email)
                .IsUnique(false);

            modelBuilder.Entity<Property>()
                .HasIndex(p => new { p.ProjectName, p.Block, p.PlotNo })
                .IsUnique(false);

            modelBuilder.Entity<Payment>()
                .HasIndex(p => p.PaymentDate)
                .IsUnique(false);

            modelBuilder.Entity<Payment>()
                .HasIndex(p => p.ReferenceNo)
                .IsUnique(false);

            // Configure decimal precision for all monetary fields
            foreach (var entityType in modelBuilder.Model.GetEntityTypes())
            {
                foreach (var property in entityType.GetProperties())
                {
                    if (property.ClrType == typeof(decimal) || property.ClrType == typeof(decimal?))
                    {
                        if (property.Name.Contains("Amount") || property.Name.Contains("Price") || 
                            property.Name.Contains("Fee") || property.Name.Contains("Charges"))
                        {
                            property.SetPrecision(15);
                            property.SetScale(2);
                        }
                        else if (property.Name.Contains("Percentage"))
                        {
                            property.SetPrecision(5);
                            property.SetScale(2);
                        }
                    }
                }
            }
        }
    }
}